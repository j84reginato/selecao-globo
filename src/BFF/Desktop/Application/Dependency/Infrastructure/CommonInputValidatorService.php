<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Iterator\Common;

/**
 * Class CommonInputValidatorService
 */
final class CommonInputValidatorService
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                Common\CommonInputValidatorIterator::class => Common\Factory\CommonInputValidatorIteratorFactory::class,
            ],
        ];
    }
}
