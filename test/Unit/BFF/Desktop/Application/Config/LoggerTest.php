<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Config;

use SelecaoGlobo\BFF\Desktop\Application\Config\Logger;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class LoggerTest
 */
class LoggerTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $config = Logger::getConfig();

        self::assertNotEmpty($config);
        self::assertIsArray($config);

        self::assertArrayHasKey('dataStore', $config);

        self::assertIsArray($config['dataStore']);
        self::assertArrayHasKey('elasticsearch', $config['dataStore']);

        self::assertIsArray($config['dataStore']);
        self::assertArrayHasKey('console', $config['dataStore']);
    }
}
