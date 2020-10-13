<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Filter;

use SelecaoGlobo\Infrastructure\Handler\API\RequestInterface;

/**
 * Interface InputFilterIteratorInterface
 */
interface InputFilterInterface
{
    /**
     * @param array            $parameters
     * @param RequestInterface $request
     */
    public function apply(array $parameters, RequestInterface $request): void;
}
