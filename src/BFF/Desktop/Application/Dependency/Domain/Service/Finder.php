<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Domain\Service;

use SelecaoGlobo\BFF\Desktop\Domain\Service\Finder\Factory\MatchesFinderFactory;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Finder\MatchesFinder;

/**
 * Class Finder
 */
final class Finder
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                MatchesFinder::class => MatchesFinderFactory::class,
            ],
        ];
    }
}
