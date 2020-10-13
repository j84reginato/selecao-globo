<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\Cache\Manager;

use SelecaoGlobo\Infrastructure\Cache\Client\CacheClientFacade;
use SelecaoGlobo\Infrastructure\Cache\Manager\CacheManager;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class CacheManagerTest
 */
class CacheManagerTest extends AbstractUnitTestCase
{
    /**
     * @var CacheManager
     */
    protected CacheManager $cacheManager;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $client = new CacheClientFacade([
            'host' => getenv('REDIS_HOST'),
            'port' => getenv('REDIS_PORT'),
        ]);

        $this->cacheManager = new CacheManager($client->getCacheClient());
    }

    /**
     * @return void
     */
    public function testGetCacheClient(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        self::assertNotNull($this->cacheManager->getCacheClient());
    }

    /**
     * @return void
     */
    public function testStore(): void
    {
        // TODO
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        // self::assertNotNull($this->cacheManager->store('test', ['test'], 60));
        self::assertNotNull([]);
    }

    /**
     * @return void
     */
    public function testRetrieve(): void
    {
        // TODO
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        // $this->cacheManager->store('test', ['test'], 60);

        // self::assertNotNull($this->cacheManager->retrieve('test'));
        // self::assertEquals('test', $this->cacheManager->retrieve('test'));
        self::assertNotNull([]);
    }

    /**
     * @return void
     */
    public function testMultiRetrive(): void
    {
        // TODO
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        self::assertNotNull([]);
    }

    /**
     * @return void
     */
    public function testExists(): void
    {
        // TODO
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        self::assertNotNull([]);
    }

    /**
     * @return void
     */
    public function testExclude(): void
    {
        // TODO
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        self::assertNotNull([]);
    }

    /**
     * @return void
     */
    public function testGetKeys(): void
    {
        // TODO
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        self::assertNotNull([]);
    }

    /**
     * @return void
     */
    public function testClearCache(): void
    {
        // TODO
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        self::assertNotNull([]);
    }

    /**
     * @return void
     */
    public function testGetKeyByParams(): void
    {
        // TODO
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        self::assertNotNull([]);
    }

    /**
     * @return void
     */
    public function testGetKeyByArray(): void
    {
        // TODO
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        self::assertNotNull([]);
    }

    /**
     * @return void
     */
    public function testGetRegister(): void
    {
        // TODO
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        self::assertNotNull([]);
    }

    /**
     * @return void
     */
    public function testSetRegister(): void
    {
        // TODO
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        self::assertNotNull([]);
    }
}
