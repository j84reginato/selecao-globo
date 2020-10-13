<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Iterator;

use SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Filter\InputFilterInterface;
use SelecaoGlobo\Infrastructure\Handler\API\RequestInterface;

/**
 * Class AbstractInputFilterIterator
 */
abstract class AbstractInputFilterIterator implements InputFilterIteratorInterface
{
    /**
     * @var array|InputFilterInterface[]
     */
    protected array $filters;

    /**
     * AbstractInputFilterIterator constructor.
     *
     * @param InputFilterInterface[] $filters
     */
    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * @param array            $parameters
     * @param RequestInterface $request
     */
    public function filter(array $parameters, RequestInterface $request): void
    {
        $parameters = $this->filterParams($parameters);

        /** @var InputFilterInterface $filter */
        foreach ($this->filters as $filter) {
            $filter->apply($parameters, $request);
        }
    }

    /**
     * @param array $requestParams
     *
     * @return array
     */
    protected function filterParams(array $requestParams): array
    {
        return array_filter($requestParams, static function ($param) {
            return $param !== null;
        });
    }

    /**
     * @param InputFilterInterface $filter
     */
    public function addFilter(InputFilterInterface $filter): void
    {
        if (empty($this->filters)) {
            $this->filters = [];
        }

        $this->filters[] = $filter;
    }
}
