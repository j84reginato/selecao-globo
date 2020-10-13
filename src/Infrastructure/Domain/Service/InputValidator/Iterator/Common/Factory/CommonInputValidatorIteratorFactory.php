<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Iterator\Common\Factory;

use SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Iterator\Common\CommonInputValidatorIterator;

/**
 * Class CommonValidatorIteratorFactory.
 */
final class CommonInputValidatorIteratorFactory
{
    /**
     * @return CommonInputValidatorIterator
     */
    public function __invoke(): CommonInputValidatorIterator
    {
        return new CommonInputValidatorIterator([]);
    }
}
