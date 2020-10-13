<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\Cache\Manager\Factory;

use Exception;
use Predis;
use Prophecy\Prophecy\ProphecyInterface;
use Prophecy\Prophet;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Cache\Client\CacheClientFacade;
use SelecaoGlobo\Infrastructure\Cache\Manager\Factory\CacheManagerFactory;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class CacheManagerFactoryTest
 */
class CacheManagerFactoryTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        /** @var ProphecyInterface|ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        $container->get(CacheClientFacade::class)->willReturn(
            (new Prophet())->prophesize(Predis\Client::class)->reveal()
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
            (new CacheManagerFactory())($this->container);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
