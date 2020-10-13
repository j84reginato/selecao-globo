<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Config;

use SelecaoGlobo\BFF\Desktop\Application\Config\Api;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class ApiTest
 */
class ApiTest extends AbstractUnitTestCase
{
    private const SPORTS_API = 'sportsApi';
    private const BASE_URI = 'baseUri';

    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $config = Api::getConfig();

        self::assertNotEmpty($config);
        self::assertIsArray($config);
        self::assertArrayHasKey(self::SPORTS_API, $config);
        self::assertArrayHasKey(self::BASE_URI, $config[self::SPORTS_API]);
        self::assertEquals(getenv('API_SPORTS_URI'), $config[self::SPORTS_API][self::BASE_URI]);
    }
}
