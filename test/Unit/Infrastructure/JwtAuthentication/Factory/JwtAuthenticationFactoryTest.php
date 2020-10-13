<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\JwtAuthentication\Factory;

use Exception;
use Prophecy\Prophecy\ProphecyInterface;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\JwtAuthentication\Factory\JwtAuthenticationFactory;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class JwtAuthenticationFactory
 */
class JwtAuthenticationFactoryTest extends AbstractUnitTestCase
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
                'jwt' => [],
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
            (new JwtAuthenticationFactory())($this->container);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
