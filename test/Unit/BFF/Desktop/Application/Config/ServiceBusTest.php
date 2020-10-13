<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Config;

use SelecaoGlobo\BFF\Desktop\Application\Config\ServiceBus;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class ServiceBusTest
 */
class ServiceBusTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $config = ServiceBus::getConfig();

        self::assertNotEmpty($config);
        self::assertIsArray($config);

        self::assertArrayHasKey('commandHandlers', $config);
        self::assertArrayHasKey('eventListeners', $config);

        self::assertIsArray($config['commandHandlers']);
        self::assertIsArray($config['eventListeners']);
    }
}
