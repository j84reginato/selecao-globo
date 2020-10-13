<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Handler\API\Request;

/**
 * Interface BodyRequestInterface
 */
interface BodyRequestInterface
{
    /**
     * @return array
     */
    public function getPayload(): array;

    /**
     * @param array $payload
     */
    public function setPayload(array $payload): void;
}
