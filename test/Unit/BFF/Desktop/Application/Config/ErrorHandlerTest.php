<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Config;

use SelecaoGlobo\BFF\Desktop\Application\Config\ErrorHandler;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class ErrorHandlerTest
 */
class ErrorHandlerTest extends AbstractUnitTestCase
{
    private const BUGSNAG = 'bugsnag';

    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $config = ErrorHandler::getConfig();

        self::assertNotEmpty($config);
        self::assertIsArray($config);

        self::assertArrayHasKey(self::BUGSNAG, $config);
        self::assertArrayHasKey('key', $config[self::BUGSNAG]);
        self::assertArrayHasKey('notify', $config[self::BUGSNAG]);

        self::assertEquals(getenv('BUGSNAG_KEY'), $config[self::BUGSNAG]['key']);
        self::assertEquals([getenv('APPLICATION_ENV')], $config[self::BUGSNAG]['notify']);
    }
}
