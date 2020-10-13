<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Config;

/**
 * Class Logger
 */
final class Logger
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            'dataStore' => [
                'elasticsearch' => [
                    'host'  => getenv('ELK_HOST'),
                    'index' => getenv('ELK_INDEX'),
                ],
                'console'       => [
                    'streamName' => 'console',
                    'level'      => "debug",
                ],
            ],
        ];
    }
}
