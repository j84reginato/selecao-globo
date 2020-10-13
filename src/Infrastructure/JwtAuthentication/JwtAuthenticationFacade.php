<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\JwtAuthentication;

use Tuupola\Middleware\JwtAuthentication;

/**
 * Class JwtAuthenticationFacade
 */
final class JwtAuthenticationFacade
{
    /**
     * @var JwtAuthentication
     */
    private JwtAuthentication $jwtAuthentication;

    /**
     * JwtAuthenticationFacade constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->jwtAuthentication = new JwtAuthentication($config);
    }

    /**
     * @return JwtAuthentication
     */
    public function getJwtAuthentication(): JwtAuthentication
    {
        return $this->jwtAuthentication;
    }
}
