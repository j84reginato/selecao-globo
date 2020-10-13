<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Domain\Service\Finder\Factory;

use Exception;
use Prophecy\Prophecy\ProphecyInterface;
use Prophecy\Prophet;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Finder\Factory\MatchesFinderFactory;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Requester\ApiSportsRequester;
use SelecaoGlobo\Infrastructure\Cache\Manager\CacheManager;
use SelecaoGlobo\Infrastructure\Cache\Manager\CacheManagerInterface;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class MatchFinderFactoryTest
 */
class MatchesFinderFactoryTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        /** @var ProphecyInterface|ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        $container->get(CacheManager::class)->willReturn(
            (new Prophet())->prophesize(CacheManagerInterface::class)->reveal()
        );
        $container->get('config')->willReturn(
            [
                'cache' => [
                    'matchesCacheKey' => 'test',
                    'enabled'         => 'test',
                ],
            ]
        );
        $container->get(ApiSportsRequester::class)->willReturn(
            (new Prophet())->prophesize(ApiSportsRequester::class)->reveal()
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
            (new MatchesFinderFactory())($this->container);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
