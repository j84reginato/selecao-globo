<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\Api\Factory;

use Exception;
use Prophecy\Prophecy\ProphecyInterface;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Api\Factory\SportsApiFactory;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class SportsApiApiFactoryTest
 */
class SportsApiFactoryTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        /** @var ProphecyInterface|ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        $container->get('config')->willReturn(
            [
                'api' => [
                    'sportsApi' => [
                        'baseUri' => 'mock',
                        'retryLimit' => 2,
                    ],
                ],
            ]
        );

        $this->container = $container->reveal();
    }

    public function testInvoke(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $exception = null;
        try {
            (new SportsApiFactory())($this->container);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
