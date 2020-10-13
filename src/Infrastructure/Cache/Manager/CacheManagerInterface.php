<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Cache\Manager;

use Predis\Client as PredisClient;

/**
 * Interface CacheManagerInterface
 */
interface CacheManagerInterface
{
    /**
     * @return PredisClient
     */
    public function getCacheClient(): PredisClient;

    /**
     * @param string $key
     * @param mixed  $values
     * @param int    $time
     *
     * @return bool
     */
    public function store(string $key, $values, int $time): bool;

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function retrieve(string $key);

    /**
     * @param array $keys
     *
     * @return array
     */
    public function multiRetrive(array $keys): array;

    /**
     * Verifica se existe a chave
     *
     * @param $key
     *
     * @return bool
     */
    public function exists($key): bool;

    /**
     * @param array $keys
     *
     * @return int
     */
    public function exclude(array $keys): int;

    /**
     * @param string $prefix
     *
     * @return array
     */
    public function getKeys(string $prefix): array;

    /**
     * @param string $prefix
     *
     * @return void
     */
    public function clearCache(string $prefix): void;

    /**
     * @param string $prefix
     * @param mixed  ...$params
     *
     * @return string
     */
    public function getKeyByParams(string $prefix, ...$params): string;

    /**
     * @param string $prefix
     * @param array  $params
     *
     * @return string
     */
    public function getKeyByArray(string $prefix, array $params): string;
}
