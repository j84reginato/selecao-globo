<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\Service\Finder\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Finder\MatchesFinder;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Requester\ApiSportsRequester;
use SelecaoGlobo\Infrastructure\Cache\Manager\CacheManager;

/**
 * Class MatchesFinderFactory
 */
final class MatchesFinderFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return MatchesFinder
     */
    public function __invoke(ContainerInterface $container): MatchesFinder
    {
        return new MatchesFinder(
            $container->get(CacheManager::class),
            $container->get(ApiSportsRequester::class),
            $container->get('config')['cache']
        );
    }
}
