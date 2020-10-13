<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop;

use SelecaoGlobo\BFF\Desktop\ConfigProvider;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class ConfigProviderTest
 */
class ConfigProviderTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testInvoke(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $configProvider = new ConfigProvider();

        self::assertIsArray($configProvider());
    }
}
