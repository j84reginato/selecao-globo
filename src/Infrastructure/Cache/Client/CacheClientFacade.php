<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Cache\Client;

use Predis\Client as PredisClient;

/**
 * Class CacheClientFacade
 */
class CacheClientFacade
{
    /**
     * @var PredisClient
     */
    private PredisClient $cacheClient;

    /**
     * CacheClientFacade constructor.
     *
     * @param array $parameters
     * @param array $options
     */
    public function __construct(array $parameters = [], array $options = [])
    {
        $this->cacheClient = new PredisClient($parameters, $options);
    }

    /**
     * @return PredisClient
     */
    public function getCacheClient(): PredisClient
    {
        return $this->cacheClient;
    }
}
