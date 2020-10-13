<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Domain\Service\Requester\Factory;

use Exception;
use Prophecy\Prophecy\ProphecyInterface;
use Prophecy\Prophet;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Requester\Factory\ApiSportsRequesterFactory;
use SelecaoGlobo\Infrastructure\Api\SportsApi;
use SelecaoGlobo\Infrastructure\Cache\Manager\CacheManager;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class ApiSportsRequesterFactoryTest
 */
class ApiSportsRequesterFactoryTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        /** @var ProphecyInterface|ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        $container->get(SportsApi::class)->willReturn(
            (new Prophet())->prophesize(SportsApi::class)->reveal()
        );
        $container->get(CacheManager::class)->willReturn(
            (new Prophet())->prophesize(CacheManager::class)->reveal()
        );
        $container->get(LoggerFacade::ELASTICSEARCH)->willReturn(
            (new Prophet())->prophesize(LoggerFacade::class)->reveal()
        );
        $container->get('config')->willReturn(
            [
                'cache' => [
                    'matchesCacheKey' => 'test',
                    'enabled'         => 'test',
                ],
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
            (new ApiSportsRequesterFactory())($this->container);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
