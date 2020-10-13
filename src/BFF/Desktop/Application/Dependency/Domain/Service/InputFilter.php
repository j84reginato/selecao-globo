<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Domain\Service;

use SelecaoGlobo\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches\Factory\ReadFilterFactory;
use SelecaoGlobo\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches\ReadFilter;

/**
 * Class InputFilter
 */
final class InputFilter
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                ReadFilter::class => ReadFilterFactory::class,
            ],
        ];
    }
}
