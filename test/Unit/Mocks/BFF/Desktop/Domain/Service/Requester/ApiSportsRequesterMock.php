<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\Requester;

use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecyInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Requester\ApiSportsRequester;
use SelecaoGlobo\Infrastructure\Api\SportsApi;
use SelecaoGlobo\Infrastructure\Cache\Manager\CacheManagerInterface;
use SelecaoGlobo\Unit\Mocks\AbstractMock;

/**
 * Class MatchesFinder
 */
class ApiSportsRequesterMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(ApiSportsRequester::class);
    }

    /**
     * @return ApiSportsRequester
     */
    public function getObjectWithMockDependencies(): ApiSportsRequester
    {
        /** @var ProphecyInterface|CacheManagerInterface $cacheManager */
        $cacheManager = $this->prophesize(CacheManagerInterface::class)->reveal();
        $sportsApi    = new SportsApi('http://172.17.0.1:8080');
        $cacheConfig = [
            'enabled'          => (bool)getenv('CACHE_ENABLED'),
            'client'           => [
                'redis' => [
                    'host' => getenv('REDIS_HOST'),
                    'port' => getenv('REDIS_PORT'),
                ],
            ],
            'matchesCacheKey'  => getenv('MATCHES_CACHE_KEY'),
            'matchesCacheTime' => getenv('MATCHES_CACHE_TIME'),
        ];

        return new ApiSportsRequester(
            $sportsApi,
            $cacheManager,
            $this->loggerFacade,
            $cacheConfig
        );
    }
}
