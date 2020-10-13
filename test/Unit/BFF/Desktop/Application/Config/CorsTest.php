<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Config;

use SelecaoGlobo\BFF\Desktop\Application\Config\Cors;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class CorsTest
 */
class CorsTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $config = Cors::getConfig();

        self::assertNotEmpty($config);
        self::assertIsArray($config);

        self::assertArrayHasKey('origin', $config);
        self::assertArrayHasKey('methods', $config);
        self::assertArrayHasKey('headers.allow', $config);
        self::assertArrayHasKey('headers.expose', $config);
        self::assertArrayHasKey('credentials', $config);
        self::assertArrayHasKey('cache', $config);

        self::assertEquals(['*'], $config['origin']);
        self::assertEquals(['GET', 'POST', 'PUT', 'PATCH', 'DELETE'], $config['methods']);
        self::assertEquals(['Content-Type', 'Accept'], $config['headers.allow']);
        self::assertEquals([], $config['headers.expose']);
        self::assertEquals(false, $config['credentials']);
        self::assertEquals(0, $config['cache']);
    }
}
