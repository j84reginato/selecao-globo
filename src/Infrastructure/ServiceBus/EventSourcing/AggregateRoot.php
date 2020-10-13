<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\EventSourcing;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Exception;
use SelecaoGlobo\Infrastructure\Domain\Exception\AggregateRootException;

/**
 * Class AggregateRoot
 */
abstract class AggregateRoot extends EventSourcedAggregateRoot
{
    /**
     * @param $event
     */
    protected function raise($event): void
    {
        $this->apply($event);
    }

    /**
     * @param $event
     * @param $context
     *
     * @throws Exception
     */
    public function raiseByEvent($event, $context): void
    {
        if (!class_exists($event)) {
            throw new AggregateRootException(
                sprintf('Classe %s inexistente', $event)
            );
        }

        $this->raise(new $event($context));
    }

    /**
     * @param array $events
     * @param array $contexts
     *
     * @throws Exception
     */
    public function raiseByMultipleEvents(array $events, array $contexts): void
    {
        foreach ($events as $index => $event) {
            $context = $contexts[$index];
            if (!class_exists($event)) {
                throw new AggregateRootException(
                    sprintf('Classe %s inexistente', $event)
                );
            }
            $this->raise(new $event($context));
        }
    }
}
