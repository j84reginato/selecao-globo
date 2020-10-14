<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Cache\Manager;

use JsonException;
use Predis\Client as PredisClient;

/**
 * Class CacheManager
 */
class CacheManager extends CacheManagerDecorator implements CacheManagerInterface
{
    /**
     * Expiration cache time (default 5 min)
     */
    private const LIFE_TIME = 300;

    /**
     * @var PredisClient
     */
    private PredisClient $cacheClient;

    /**
     * CacheManager constructor.
     *
     * @param PredisClient $cacheClient
     */
    public function __construct(PredisClient $cacheClient)
    {
        $this->cacheClient = $cacheClient;
    }

    /**
     * @return PredisClient
     */
    public function getCacheClient(): PredisClient
    {
        return $this->cacheClient;
    }

    /**
     * @param string $key
     * @param mixed  $values
     * @param int    $time
     *
     * @return bool
     */
    public function store(string $key, $values, int $time): bool
    {
        return (bool)$this->cacheClient->setex($key, $time, serialize($values));
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function retrieve(string $key)
    {
        if (!getenv('CACHE_ENABLED') || !$this->exists($key)) {
            return null;
        }

        return unserialize($this->cacheClient->get($key), [true]);
    }

    /**
     * @param array $keys
     *
     * @return array
     */
    public function multiRetrive(array $keys): array
    {
        return $this->cacheClient->mget($keys);
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function exists($key): bool
    {
        return (bool)$this->cacheClient->exists($key);
    }

    /**
     * @param array $keys
     *
     * @return int
     */
    public function exclude(array $keys): int
    {
        return $this->cacheClient->del($keys);
    }

    /**
     * @param string $prefix
     *
     * @return array
     */
    public function getKeys(string $prefix): array
    {
        $keys = sprintf($prefix, '*');

        return $this->cacheClient->keys($keys);
    }

    /**
     * @param string $prefix
     *
     * @return void
     */
    public function clearCache(string $prefix): void
    {
        $keys = sprintf($prefix, '*');
        foreach ($this->cacheClient->keys($keys) as $key) {
            $this->cacheClient->del($key);
        }
    }

    /**
     * @param string $prefix
     * @param mixed  ...$params
     *
     * @return string
     */
    public function getKeyByParams(string $prefix, ...$params): string
    {
        return sprintf($prefix, sha1(serialize($params)));
    }

    /**
     * @param string $prefix
     * @param array  $params
     *
     * @return string
     */
    public function getKeyByArray(string $prefix, array $params): string
    {
        return sprintf($prefix, sha1(serialize($params)));
    }

    /**
     * @param $key
     *
     * @return array
     * @throws JsonException
     */
    public function getRegister($key): array
    {
        if (!getenv('CACHE_ENABLED') || !$this->exists($key)) {
            return [];
        }

        return json_decode($this->cacheClient->get($key), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param string   $key
     * @param          $value
     * @param int|null $lifeTime
     *
     * @throws JsonException
     */
    public function setRegister(string $key, $value, ?int $lifeTime = self::LIFE_TIME): void
    {
        if (getenv('CACHE_ENABLED')) {
            $this->cacheClient->setex($key, $lifeTime, json_encode($value, JSON_THROW_ON_ERROR));
        }
    }
}
