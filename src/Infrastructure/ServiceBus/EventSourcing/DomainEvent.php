<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\EventSourcing;

use DateTimeImmutable;
use SelecaoGlobo\Infrastructure\ServiceBus\Event\EventInterface;

/**
 * Interface DomainEvent
 */
interface DomainEvent extends EventInterface
{
    /**
     * Deve retornar o id do Aggregate.
     *
     * @return mixed
     */
    public function aggregateId(): string;

    /**
     * DateTimeImmutable de quando o evento foi criado.
     *
     * @return mixed
     */
    public function recordedAt(): DateTimeImmutable;

    /**
     * Deve retornar o evento serializado como array.
     *
     * @return array
     */
    public function serialize(): array;
}
