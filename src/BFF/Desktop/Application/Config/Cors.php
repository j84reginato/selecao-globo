<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Config;

/**
 * Class Cors
 */
final class Cors
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            'origin'         => ['*'],
            'methods'        => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'],
            'headers.allow'  => ['Content-Type', 'Accept'],
            'headers.expose' => [],
            'credentials'    => false,
            'cache'          => 0,
        ];
    }
}
