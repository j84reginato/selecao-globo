<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Iterator\Common\CommonInputFilterIterator;
use SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Iterator\Common\Factory\CommonInputFilterIteratorFactory;

/**
 * Class CommonInputFilterService
 */
final class CommonInputFilterService
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                CommonInputFilterIterator::class => CommonInputFilterIteratorFactory::class,
            ],
        ];
    }
}
