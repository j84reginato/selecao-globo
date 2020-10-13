<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\Command;

/**
 * Interface CommandInterface
 */
interface CommandInterface
{
    /**
     * Factory para criar command a partir de array
     *
     * @param array $data
     */
    public static function fromArray(array $data);

    /**
     * Serializa os parametros do command
     *
     * @return array
     */
    public function toArray(): array;
}
