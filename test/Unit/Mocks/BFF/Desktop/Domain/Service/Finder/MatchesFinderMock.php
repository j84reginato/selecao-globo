<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\Finder;

use JsonException;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecyInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Finder\MatchesFinder;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Requester\ApiSportsRequester;
use SelecaoGlobo\Infrastructure\Cache\Manager\CacheManagerInterface;
use SelecaoGlobo\Infrastructure\Handler\API\RequestInterface;
use SelecaoGlobo\Unit\Mocks\AbstractMock;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\Requester\ApiSportsRequesterMock;

/**
 * Class MatchesFinderMock
 */
class MatchesFinderMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     * @throws JsonException
     */
    public function getMock(): ObjectProphecy
    {
        /** @var ObjectProphecy|MatchesFinder $service */
        $service = $this->prophesize(MatchesFinder::class);

        $service->getList(Argument::type(RequestInterface::class))->will(function () {
            return require APP_ROOT . '/test/datasources/sports.api.response.php';
        });

        return $service;
    }

    /**
     * @return MatchesFinder
     */
    public function getObjectWithMockDependencies(): MatchesFinder
    {
        /** @var ProphecyInterface|CacheManagerInterface $cacheManager */
        $cacheManager = $this->prophesize(CacheManagerInterface::class)->reveal();

        /** @var ProphecyInterface|ApiSportsRequester $apiSportsRequester */
        $apiSportsRequester = (new ApiSportsRequesterMock($this->loggerFacade))->getObjectWithMockDependencies();

        $cacheConfig = [
            'enabled'         => false,
            'matchesCacheKey' => 'soccer:matches:%s',
        ];

        return new MatchesFinder(
            $cacheManager,
            $apiSportsRequester,
            $cacheConfig
        );
    }
}
