<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\CommandBus;

use SelecaoGlobo\Infrastructure\ServiceBus\Command\CommandInterface;

/**
 * Trait CommandBusTrait
 */
trait CommandBusTrait
{
    /**
     * @var CommandBusInterface
     */
    protected CommandBusInterface $commandBus;

    /**
     * @param CommandBusInterface $commandBus
     */
    public function setCommandBus(CommandBusInterface $commandBus): void
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param CommandInterface $command
     */
    public function dispatchCommand(CommandInterface $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
