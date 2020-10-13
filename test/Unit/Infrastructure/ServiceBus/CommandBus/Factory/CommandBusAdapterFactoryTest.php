<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\ServiceBus\CommandBus\Factory;

use Exception;
use Prophecy\Prophecy\ProphecyInterface;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\ServiceBus\CommandBus\Factory\CommandBusAdapterFactory;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class AdapterCommandBusFactory
 */
class CommandBusAdapterFactoryTest extends AbstractUnitTestCase
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
            (new CommandBusAdapterFactory())();
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
