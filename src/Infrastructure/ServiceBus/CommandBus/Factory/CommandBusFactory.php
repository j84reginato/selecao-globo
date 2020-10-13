<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\CommandBus\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;
use SelecaoGlobo\Infrastructure\ServiceBus\CommandBus\CommandBus;
use SelecaoGlobo\Infrastructure\ServiceBus\CommandBus\CommandBusAdapter;
use SelecaoGlobo\Infrastructure\ServiceBus\CommandBus\CommandBusTrait;
use SelecaoGlobo\Infrastructure\ServiceBus\CommandHandler\CommandHandlerAdapter;
use SelecaoGlobo\Infrastructure\ServiceBus\EventBus\EventBusInterface;
use SelecaoGlobo\Infrastructure\ServiceBus\EventBus\EventBusTrait;
use SelecaoGlobo\Infrastructure\ServiceBus\Middleware\LogCommandsMiddleware;
use SelecaoGlobo\Infrastructure\ServiceBus\Middleware\TransactionalMiddleware;

/**
 * Class CommandBusFactory
 */
final class CommandBusFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CommandBus
     */
    public function __invoke(ContainerInterface $container): CommandBus
    {
        $handlers           = $container->get('config')['serviceBus']['commandHandlers'];
        $broadwayCommandBus = $container->get(CommandBusAdapter::class);

        $commandHandlers = [];

        foreach ($handlers as $handler) {
            $commandHandlers[] = $container->get($handler);
        }

        foreach ($commandHandlers as $commandHandler) {
            $broadwayCommandBus->subscribe($commandHandler);
        }

        $commandBus = new CommandBus();
        $commandBus->appendMiddleware(
            new LogCommandsMiddleware(($container->get(LoggerFacade::CONSOLE))->getLogger())
        );

        $commandBus->appendMiddleware(new CommandHandlerAdapter($broadwayCommandBus));

        // Inject command commandBus
        foreach ($commandHandlers as $commandHandler) {
            foreach (class_uses($commandHandler) as $trait) {
                if ($trait !== CommandBusTrait::class) {
                    continue;
                }

                $commandHandler->setCommandBus($commandBus);
            }
        }

        // Inject event commandBus
        foreach ($commandHandlers as $commandHandler) {
            foreach (class_uses($commandHandler) as $trait) {
                if ($trait !== EventBusTrait::class) {
                    continue;
                }

                $commandHandler->setEventBus($container->get(EventBusInterface::class));
            }
        }

        return $commandBus;
    }
}
