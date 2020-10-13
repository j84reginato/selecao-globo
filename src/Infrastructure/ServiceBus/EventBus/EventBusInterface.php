<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\EventBus;

use IteratorAggregate;

/**
 * Interface EventBusInterface
 */
interface EventBusInterface
{
    public const NAME = 'eventBus';

    /**
     * @param IteratorAggregate $event
     *
     * @return mixed
     */
    public function publish(IteratorAggregate $event);
}
