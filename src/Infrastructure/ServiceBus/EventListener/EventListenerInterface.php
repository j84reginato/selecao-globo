<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\EventListener;

use Broadway\Domain\DomainEventStream;

/**
 * Interface EventListenerInterface
 */
interface EventListenerInterface
{
    /**
     * @param DomainEventStream $command
     * @param callable          $next
     *
     * @return mixed
     */
    public function handle(DomainEventStream $command, callable $next);
}
