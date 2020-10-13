<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Config;

use SelecaoGlobo\BFF\Desktop\Application\Config\HealthCheck;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class HealthCheckTest
 */
class HealthCheckTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $config = HealthCheck::getConfig();

        self::assertNotEmpty($config);
        self::assertIsArray($config);

        self::assertArrayHasKey('baseUri', $config);

        self::assertEquals(getenv('HEALTHCHECKS_PING_URL'), $config['baseUri']);
    }
}
