<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Handler\API;

/**
 * Interface ResponseInterface
 */
interface ResponseInterface
{
    /**
     * @param RequestInterface $request
     *
     * @return array
     */
    public function process(RequestInterface $request): array;
}
