<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\EventBus;

use IteratorAggregate;

/**
 * Trait EventBusTrait
 */
trait EventBusTrait
{
    /**
     * @var EventBusInterface
     */
    protected EventBusInterface $eventBus;

    /**
     * @param EventBusInterface $commandBus
     */
    public function setEventBus(EventBusInterface $commandBus): void
    {
        $this->eventBus = $commandBus;
    }

    /**
     * @param IteratorAggregate $events
     */
    public function publish(IteratorAggregate $events): void
    {
        $this->eventBus->publish($events);
    }
}
