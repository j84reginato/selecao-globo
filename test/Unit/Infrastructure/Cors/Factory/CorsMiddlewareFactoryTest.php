<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\Cors\Factory;

use Exception;
use Prophecy\Prophecy\ProphecyInterface;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Cors\Factory\CorsMiddlewareFactory;
use SelecaoGlobo\Unit\AbstractUnitTestCase;
use Tuupola;

/**
 * Class CorsMiddlewareFactoryTest
 */
class CorsMiddlewareFactoryTest extends AbstractUnitTestCase
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
                'cors' => [],
            ]
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
            (new CorsMiddlewareFactory())($this->container);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
