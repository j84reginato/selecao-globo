<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\CommandBus;

use Broadway\CommandHandling\CommandBus;
use Broadway\CommandHandling\CommandHandler;
use SelecaoGlobo\Infrastructure\ServiceBus\Command\CommandInterface;

/**
 * Class CommandBusAdapter
 */
class CommandBusAdapter implements CommandBusInterface
{
    /**
     * @var CommandBus
     */
    private CommandBus $commandBus;

    /**
     * BroadwayCommandBus constructor.
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * Registra os commandHandlers que poderão tratar o command
     *
     * @param CommandHandler $commandHandler
     */
    public function subscribe(CommandHandler $commandHandler): void
    {
        $this->commandBus->subscribe($commandHandler);
    }

    /**
     * Dispara para um commandHandler poder tratar
     *
     * @param CommandInterface $command
     */
    public function dispatch(CommandInterface $command)
    {
        $this->commandBus->dispatch($command);
    }
}
