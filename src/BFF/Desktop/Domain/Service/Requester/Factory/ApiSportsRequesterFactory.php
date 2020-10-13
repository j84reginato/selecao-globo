<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\Service\Requester\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Requester\ApiSportsRequester;
use SelecaoGlobo\Infrastructure\Api\SportsApi;
use SelecaoGlobo\Infrastructure\Cache\Manager\CacheManager;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;

/**
 * Class ApiSportsRequesterFactory
 */
final class ApiSportsRequesterFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ApiSportsRequester
     */
    public function __invoke(ContainerInterface $container): ApiSportsRequester
    {
        return new ApiSportsRequester(
            $container->get(SportsApi::class),
            $container->get(CacheManager::class),
            $container->get(LoggerFacade::ELASTICSEARCH),
            $container->get('config')['cache']
        );
    }
}
