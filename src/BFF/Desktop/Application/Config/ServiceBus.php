<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Config;

use SelecaoGlobo\BFF\Desktop\Handler\CLI\ApiStatus\ApiStatusHandler;
use SelecaoGlobo\BFF\Desktop\Handler\CLI\Matches\MatchesHandler;

/**
 * Class ServiceBus
 */
final class ServiceBus
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            'commandHandlers' => [
                ApiStatusHandler::class,
                MatchesHandler::class,
            ],
            'eventListeners'  => [

            ],
        ];
    }
}
