<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\CommandBus;

use SelecaoGlobo\Infrastructure\ServiceBus\Command\CommandInterface;

/**
 * Interface CommandBusInterface
 */
interface CommandBusInterface
{
    public const NAME = 'commandBus';

    /**
     * @param CommandInterface $command
     *
     * @return mixed
     */
    public function dispatch(CommandInterface $command);
}
