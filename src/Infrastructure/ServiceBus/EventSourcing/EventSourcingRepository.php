<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\EventSourcing;

use Broadway\Domain\AggregateRoot as BroadwayAggregateRoot;
use Broadway\EventSourcing\EventSourcingRepository as BaseEventSourcingRepository;

/**
 * Class EventSourcingRepository
 */
class EventSourcingRepository
{
    /**
     * @var BaseEventSourcingRepository
     */
    private BaseEventSourcingRepository $repository;

    /**
     * EventSourcingRepository constructor.
     *
     * @param BaseEventSourcingRepository $repository
     */
    public function __construct(BaseEventSourcingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     *
     * @return BroadwayAggregateRoot
     */
    public function load($id): BroadwayAggregateRoot
    {
        return $this->repository->load($id);
    }

    /**
     * @param AggregateRoot $aggregateRoot
     */
    public function append(AggregateRoot $aggregateRoot): void
    {
        $this->repository->save($aggregateRoot);
    }
}
