<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Iterator;

use SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Filter\InputFilterInterface;
use SelecaoGlobo\Infrastructure\Handler\API\RequestInterface;

/**
 * Interface FilterManagerInterface
 */
interface InputFilterIteratorInterface
{
    /**
     * @param array            $parameters
     * @param RequestInterface $request
     */
    public function filter(array $parameters, RequestInterface $request): void;

    /**
     * @param InputFilterInterface $filter
     */
    public function addFilter(InputFilterInterface $filter): void;
}
