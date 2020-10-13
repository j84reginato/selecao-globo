<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Handler\API\Request;

use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\Factory\ReadRequestFactory;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;

/**
 * Class APIRequest
 */
final class APIRequest
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                ReadRequest::class => ReadRequestFactory::class,
            ],
        ];
    }
}
