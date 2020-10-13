<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\ErrorHandler\Listener\Factory;

use Bugsnag;
use Exception;
use Prophecy\Prophecy\ProphecyInterface;
use Prophecy\Prophet;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\ErrorHandler\Client\BugsnagClientFacade;
use SelecaoGlobo\Infrastructure\ErrorHandler\Listener\Factory\BugsnagListenerFactory;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class BugsnagListenerFactory
 */
class BugsnagListenerFactoryTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        /** @var ProphecyInterface|ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        $container->get(BugsnagClientFacade::class)->willReturn(
            (new Prophet())->prophesize(Bugsnag\Client::class)->reveal()
        );

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
            (new BugsnagListenerFactory())($this->container);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
