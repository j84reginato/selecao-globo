<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\Cache\Client;

use SelecaoGlobo\Infrastructure\Cache\Client\CacheClientFacade;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class CacheClientFacadeTest
 */
final class CacheClientFacadeTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetCacheClient(): void
    {
        $cacheClientFacade = new CacheClientFacade([], []);

        self::assertNotNull($cacheClientFacade->getCacheClient());
    }
}
