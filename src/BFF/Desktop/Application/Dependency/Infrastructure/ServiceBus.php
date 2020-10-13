<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\Infrastructure\ServiceBus\CommandBus;
use SelecaoGlobo\Infrastructure\ServiceBus\EventBus;

/**
 * Class ServiceBus
 */
final class ServiceBus
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                CommandBus\CommandBusAdapter::class  => CommandBus\Factory\CommandBusAdapterFactory::class,
                CommandBus\CommandBusInterface::NAME => CommandBus\Factory\CommandBusFactory::class,
                EventBus\EventBusInterface::NAME     => EventBus\Factory\EventBusFactory::class,
            ],
        ];
    }
}
