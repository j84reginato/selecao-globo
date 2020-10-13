<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Domain\Service;

use SelecaoGlobo\BFF\Desktop\Domain\Service\Hydrator\Factory\MatchesHydratorFactory;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Hydrator\MatchesHydrator;

/**
 * Class Hydrator
 */
final class Hydrator
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'invokables' => [
                MatchesHydrator::class,
            ],
        ];
    }
}
