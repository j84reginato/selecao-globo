<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\CommandBus\Factory;

use Broadway\CommandHandling\SimpleCommandBus;
use SelecaoGlobo\Infrastructure\ServiceBus\CommandBus\CommandBusAdapter;

/**
 * Class AdapterCommandBusFactory
 */
final class CommandBusAdapterFactory
{
    /**
     * @return CommandBusAdapter
     */
    public function __invoke(): CommandBusAdapter
    {
        return new CommandBusAdapter(new SimpleCommandBus());
    }
}
