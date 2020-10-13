<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Handler\API\Action;

use SelecaoGlobo\BFF\Desktop\Handler\API\Internal;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Action\Factory\ReadHandlerFactory;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Action\ReadHandler;

/**
 * Class APIHandler
 */
final class APIHandler
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'invokables' => [
                Internal\AliveHandler::class,
            ],
            'factories'  => [
                ReadHandler::class => ReadHandlerFactory::class,
            ],
        ];
    }
}
