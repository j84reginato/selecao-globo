<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Domain\Service;

use SelecaoGlobo\BFF\Desktop\Domain\Service\Requester\ApiSportsRequester;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Requester\Factory\ApiSportsRequesterFactory;

/**
 * Class Requester
 */
final class Requester
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                ApiSportsRequester::class => ApiSportsRequesterFactory::class,
            ],
        ];
    }
}
