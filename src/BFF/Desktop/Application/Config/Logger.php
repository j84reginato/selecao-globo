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
                    'host'               => getenv('ELK_HOST'),
                    'port'               => getenv('ELK_PORT') ?: null,
                    'index'              => getenv('ELK_INDEX'),
                    'transport'          => getenv('ELK_TRANSPORT') ?: null,
                    'awsRegion'          => getenv('ELK_REGION'),
                    'awsAccessKeyId'     => getenv('ELK_KEY'),
                    'awsSecretAccessKey' => getenv('ELK_SECRET'),
                ],
                'console'       => [
                    'streamName' => 'console',
                    'level'      => "debug",
                ],
            ],
        ];
    }
}
