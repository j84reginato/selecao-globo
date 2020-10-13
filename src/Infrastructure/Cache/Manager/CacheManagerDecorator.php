<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Cache\Manager;

use Predis\Client as PredisClient;

/**
 * Class CacheManagerDecorator
 */
abstract class CacheManagerDecorator
{
    /**
     * @return PredisClient
     */
    abstract public function getCacheClient(): PredisClient;

    /**
     * @param string $key
     * @param mixed  $values
     * @param int    $time
     *
     * @return bool
     */
    abstract public function store(string $key, $values, int $time): bool;

    /**
     * @param string $key
     *
     * @return mixed
     */
    abstract public function retrieve(string $key);

    /**
     * @param array $keys
     *
     * @return array
     */
    abstract public function multiRetrive(array $keys): array;

    /**
     * @param $key
     *
     * @return bool
     */
    abstract public function exists($key): bool;

    /**
     * @param array $keys
     *
     * @return int
     */
    abstract public function exclude(array $keys): int;

    /**
     * @param string $prefix
     *
     * @return array
     */
    abstract public function getKeys(string $prefix): array;

    /**
     * @param string $prefix
     *
     * @return void
     */
    abstract public function clearCache(string $prefix): void;

    /**
     * @param string $prefix
     * @param mixed  ...$params
     *
     * @return string
     */
    abstract public function getKeyByParams(string $prefix, ...$params): string;

    /**
     * @param string $prefix
     * @param array  $params
     *
     * @return string
     */
    abstract public function getKeyByArray(string $prefix, array $params): string;

    /**
     * @param $key
     *
     * @return array
     */
    abstract public function getRegister($key): array;

    /**
     * @param string   $key
     * @param mixed    $value
     * @param int|null $lifeTime
     */
    abstract public function setRegister(string $key, $value, ?int $lifeTime = null);
}
