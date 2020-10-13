<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Dependency\Handler\API\Action;

use SelecaoGlobo\BFF\Desktop\Application\Dependency\Handler\API\Action\APIHandler;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class APIHandlerTest
 */
class APIHandlerTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $dependencies = APIHandler::getDependencies();

        self::assertNotEmpty($dependencies);
        self::assertIsArray($dependencies);
    }
}
