<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Config;

use SelecaoGlobo\BFF\Desktop\Application\Config\Cache;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class CacheTest
 */
class CacheTest extends AbstractUnitTestCase
{
    private const ENABLED     = 'enabled';
    private const CLIENT      = 'client';
    private const REDIS       = 'redis';
    private const HOST_FIELD  = 'host';
    private const PORT_FIELD  = 'port';

    private const LOG_MSG = "Testing the method %s with parameters: %s";

    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf(self::LOG_MSG, __METHOD__, 'none')
        );

        $config = Cache::getConfig();

        self::assertNotEmpty($config);
        self::assertIsArray($config);

        self::assertArrayHasKey(self::CLIENT, $config);
        self::assertArrayHasKey(self::ENABLED, $config);
    }

    /**
     * @return void
     */
    public function testGetCacheClientConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf(self::LOG_MSG, __METHOD__, 'none')
        );

        $config = Cache::getConfig()[self::CLIENT];

        self::assertNotEmpty($config);
        self::assertIsArray($config);

        self::assertArrayHasKey(self::REDIS, $config);
    }

    /**
     * @return void
     */
    public function testGetDefaultRedisConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf(self::LOG_MSG, __METHOD__, 'none')
        );

        $config = Cache::getConfig()[self::CLIENT][self::REDIS];

        self::assertNotEmpty($config);
        self::assertIsArray($config);

        self::assertArrayHasKey(self::HOST_FIELD, $config);
        self::assertEquals(getenv('REDIS_HOST'), $config[self::HOST_FIELD]);

        self::assertArrayHasKey(self::PORT_FIELD, $config);
        self::assertEquals(getenv('REDIS_PORT'), $config[self::PORT_FIELD]);
    }
}
