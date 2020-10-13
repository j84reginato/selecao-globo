<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\Middleware;

use Broadway\Domain\DomainEventStream;
use Broadway\Domain\DomainMessage;
use Psr\Log\LoggerInterface;
use SelecaoGlobo\Infrastructure\ServiceBus\Event\EventInterface;
use SelecaoGlobo\Infrastructure\ServiceBus\EventListener\EventListenerInterface;
use SelecaoGlobo\Infrastructure\ServiceBus\EventSourcing\DomainEvent;

/**
 * Class LogEventsMiddleware
 */
class LogEventsMiddleware implements EventListenerInterface
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * LogEventsMiddleware constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param DomainEventStream $events
     * @param callable          $next
     */
    public function handle(DomainEventStream $events, callable $next)
    {
        /** @var DomainMessage $event */
        foreach ($events as $event) {
            /** @var DomainEvent $domainEvent */
            $domainEvent = $event->getPayload();
            $message     = [
                'event_class'  => get_class($domainEvent),
                'event_name'   => $this->getEventName($domainEvent),
                'aggregate_id' => $domainEvent->aggregateId(),
                'payload'      => $domainEvent->serialize(),
                'recorded_at'  => $domainEvent->recordedAt()->format('c'),
            ];
            $this->logger->info('Event was published', $message);
        }

        $next($events);
    }

    /**
     * @param EventInterface $command
     *
     * @return string
     */
    private function getEventName(EventInterface $command): string
    {
        $className   = explode('\\', get_class($command));
        $className   = end($className);
        $splitedName = preg_split('/(?=[A-Z])/', $className, -1, PREG_SPLIT_NO_EMPTY);
        return implode(' ', $splitedName);
    }
}
