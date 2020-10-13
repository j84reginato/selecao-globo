<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Iterator\Common\Factory;

use SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Iterator\Common\CommonInputFilterIterator;

/**
 * Class CommonFilterIteratorFactory.
 */
final class CommonInputFilterIteratorFactory
{
    /**
     * @return CommonInputFilterIterator
     */
    public function __invoke(): CommonInputFilterIterator
    {
        return new CommonInputFilterIterator([]);
    }
}
