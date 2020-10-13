<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\Logger\Logger\Factory;

use Exception;
use Prophecy\Prophecy\ProphecyInterface;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Logger\Logger\Factory\LoggerFactory;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class LoggerFactoryTest
 */
class LoggerFactoryTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        /** @var ProphecyInterface|ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        $this->container = $container->reveal();
    }

    /**
     * @return void
     */
    public function testInvoke(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $exception = null;
        try {
            (new LoggerFactory())($this->container, 'unit-test');
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
