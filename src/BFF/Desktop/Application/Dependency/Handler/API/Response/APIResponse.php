<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Handler\API\Response;

use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Response\Factory\ReadResponseFactory;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Response\ReadResponse;

/**
 * Class APIResponse
 */
final class APIResponse
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                ReadResponse::class => ReadResponseFactory::class,
            ],
        ];
    }
}
