<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Api\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Api\SportsApi;

/**
 * Class SportsApiFactory
 */
final class SportsApiFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return SportsApi
     */
    public function __invoke(ContainerInterface $container): SportsApi
    {
        return new SportsApi(
            $container->get('config')['api']['sportsApi']['baseUri'],
            $container->get('config')['api']['sportsApi']['retryLimit']
        );
    }
}
