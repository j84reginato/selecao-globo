<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\Api;

use SelecaoGlobo\Infrastructure\Api\SportsApi;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * class SportsApiTest
 */
class SportsApiTest extends AbstractUnitTestCase
{
    /**
     * @var SportsApi
     */
    protected SportsApi $sportsApi;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->sportsApi = new SportsApi('unit-test', 5);
    }

    /**
     * @return void
     */
    public function testGetClient(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        static::assertNotEmpty($this->sportsApi->getClient());
    }

    /**
     * @return void
     */
    public function testGetBaseUri(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        static::assertNotEmpty($this->sportsApi->getBaseUri());
        static::assertEquals('unit-test', $this->sportsApi->getBaseUri());
    }
}
