<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Config;

/**
 * Class JwtAuthentication
 */
final class JwtAuthentication
{
    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            'secret' => getenv('JWT_SECRET'),
            'secure' => false,
            'path'   => '/api',
        ];
    }
}
