<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\ErrorHandler\Handler\Factory;

use Exception;
use Laminas\Stratigility\Middleware\ErrorHandler;
use Prophecy\Prophecy\ProphecyInterface;
use Prophecy\Prophet;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\ErrorHandler\Handler\Factory\ErrorHandlerFactory;
use SelecaoGlobo\Infrastructure\ErrorHandler\Listener\BugsnagListener;
use SelecaoGlobo\Infrastructure\ErrorHandler\Listener\ElasticListener;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class ErrorHandlerFactoryTest
 */
class ErrorHandlerFactoryTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        /** @var ProphecyInterface|ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        $container->get(BugsnagListener::class)->willReturn(
            (new Prophet())->prophesize(BugsnagListener::class)->reveal()
        );

        $container->get(ElasticListener::class)->willReturn(
            (new Prophet())->prophesize(ElasticListener::class)->reveal()
        );

        $container->get(ErrorHandler::class)->willReturn(
            (new Prophet())->prophesize(ErrorHandler::class)->reveal()
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
            (new ErrorHandlerFactory())(
                $this->container,
                'mock',
                function () {
                    return $this->container->get(ErrorHandler::class);
                }
            );
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
