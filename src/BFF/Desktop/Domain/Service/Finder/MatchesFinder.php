<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\Service\Finder;

use JsonException;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Requester\ApiSportsRequester;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;
use SelecaoGlobo\Infrastructure\Cache\Manager\CacheManagerInterface;
use SelecaoGlobo\Infrastructure\Handler\API\RequestInterface;

/**
 * Class MatchesFinder
 */
class MatchesFinder
{
    /**
     * @var CacheManagerInterface
     */
    private CacheManagerInterface $cacheManager;

    /**
     * @var ApiSportsRequester
     */
    private ApiSportsRequester $apiSportsRequester;

    /**
     * @var array
     */
    private array $cacheConfig;

    /**
     * MatchesFinder constructor.
     *
     * @param CacheManagerInterface $cacheManager
     * @param ApiSportsRequester    $apiSportsRequester
     * @param array                 $cacheConfig
     */
    public function __construct(
        CacheManagerInterface $cacheManager,
        ApiSportsRequester $apiSportsRequester,
        array $cacheConfig
    ) {
        $this->cacheManager       = $cacheManager;
        $this->apiSportsRequester = $apiSportsRequester;
        $this->cacheConfig        = $cacheConfig;
    }

    /**
     * @param RequestInterface|ReadRequest $request
     *
     * @return mixed[]
     * @throws JsonException
     */
    public function getList(RequestInterface $request): array
    {
        $cacheKey = sprintf($this->cacheConfig['matchesCacheKey'], $request->getAttribute());
        if ((bool)$this->cacheConfig['enabled'] && $response = $this->cacheManager->getRegister($cacheKey)) {
            return $response;
        }

        return $this->apiSportsRequester->call($request->getAttribute());
    }
}
