<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\EventBus;

use Broadway\Domain\DomainEventStream;
use Broadway\EventHandling\EventBus;
use SelecaoGlobo\Infrastructure\ServiceBus\EventListener\EventListenerInterface;

/**
 * Class EventBusAdapter
 */
class EventBusAdapter implements EventListenerInterface
{
    /**
     * @var EventBus
     */
    private EventBus $bus;

    /**
     * BroadwayEventBusMiddleware constructor.
     *
     * @param EventBus $bus
     */
    public function __construct(EventBus $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @param DomainEventStream $events
     * @param callable          $next
     */
    public function handle(DomainEventStream $events, callable $next): void
    {
        $this->bus->publish($events);
        $next($events);
    }
}
