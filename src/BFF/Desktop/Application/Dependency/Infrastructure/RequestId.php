<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure;

use SelecaoGlobo\Infrastructure\RequestId\Factory\RequestIdMiddlewareFactory;
use SelecaoGlobo\Infrastructure\RequestId\RequestIdMiddlewareFacade;

/**
 * Class RequestId
 */
final class RequestId
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                RequestIdMiddlewareFacade::class => RequestIdMiddlewareFactory::class,
            ],
        ];
    }
}
