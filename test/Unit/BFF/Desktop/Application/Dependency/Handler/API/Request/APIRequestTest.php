<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Dependency\Handler\API\Request;

use SelecaoGlobo\BFF\Desktop\Application\Dependency\Handler\API\Request\APIRequest;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class APIRequestTest
 */
class APIRequestTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $dependencies = APIRequest::getDependencies();

        self::assertNotEmpty($dependencies);
        self::assertIsArray($dependencies);
    }
}
