<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Config;

use SelecaoGlobo\BFF\Desktop\Application\Config\JwtAuthentication;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class JwtAuthenticationTest
 */
class JwtAuthenticationTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $config = JwtAuthentication::getConfig();

        self::assertNotEmpty($config);
        self::assertIsArray($config);

        self::assertArrayHasKey('secret', $config);
        self::assertArrayHasKey('secure', $config);
        self::assertArrayHasKey('path', $config);

        self::assertEquals(getenv('JWT_SECRET'), $config['secret']);
        self::assertEquals(false, $config['secure']);
        self::assertEquals('/api', $config['path']);
    }
}
