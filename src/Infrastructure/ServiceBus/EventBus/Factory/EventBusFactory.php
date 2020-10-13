<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\EventBus\Factory;

use Broadway\EventHandling\SimpleEventBus;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;
use SelecaoGlobo\Infrastructure\ServiceBus\EventBus\EventBus;
use SelecaoGlobo\Infrastructure\ServiceBus\EventBus\EventBusAdapter;
use SelecaoGlobo\Infrastructure\ServiceBus\Middleware\LogEventsMiddleware;

/**
 * Class EventBusFactory
 */
final class EventBusFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return EventBus
     */
    public function __invoke(ContainerInterface $container): EventBus
    {
        $eventBus  = new SimpleEventBus;
        $listeners = $container->get('config')['event_bus']['listeners'];

        foreach ($listeners as $handlerService) {
            $eventBus->subscribe($container->get($handlerService));
        }

        $eventBusSupportingMiddleware = new EventBus();
        $eventBusSupportingMiddleware->appendMiddleware(
            new LogEventsMiddleware($container->get(LoggerFacade::ELASTICSEARCH))
        );
        $eventBusSupportingMiddleware->appendMiddleware(new EventBusAdapter($eventBus));

        return $eventBusSupportingMiddleware;
    }
}
