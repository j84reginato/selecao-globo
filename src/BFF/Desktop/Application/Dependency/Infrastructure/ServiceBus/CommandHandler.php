<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure\ServiceBus;

use SelecaoGlobo\BFF\Desktop\Handler\CLI\ApiStatus\ApiStatusHandler;
use SelecaoGlobo\BFF\Desktop\Handler\CLI\ApiStatus\Factory\ApiStatusHandlerFactory;
use SelecaoGlobo\BFF\Desktop\Handler\CLI\Matches\Factory\MatchesHandlerFactory;
use SelecaoGlobo\BFF\Desktop\Handler\CLI\Matches\MatchesHandler;

/**
 * Class CommandHandler
 */
final class CommandHandler
{
    /**
     * @return array
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                ApiStatusHandler::class => ApiStatusHandlerFactory::class,
                MatchesHandler::class   => MatchesHandlerFactory::class,
            ],
        ];
    }
}
