<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Config;

/**
 * Class ErrorHandler
 */
final class ErrorHandler
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            'bugsnag' => [
                'key'    => getenv('BUGSNAG_KEY'),
                'notify' => [getenv('APPLICATION_ENV')],
            ],
        ];
    }
}
