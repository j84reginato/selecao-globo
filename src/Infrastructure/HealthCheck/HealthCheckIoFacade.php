<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\HealthCheck;

use GuzzleHttp\Client;

/**
 * class HealthCheckIoFacade
 */
final class HealthCheckIoFacade
{
    /**
     * @var Client
     */
    private Client $healthCheckIo;

    /**
     * HealthCheckIoFacade constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->healthCheckIo = new Client($config);
    }

    /**
     * @return Client
     */
    public function getHealthCheckIo(): Client
    {
        return $this->healthCheckIo;
    }
}
