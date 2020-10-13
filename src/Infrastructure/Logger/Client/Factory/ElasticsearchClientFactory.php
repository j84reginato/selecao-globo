<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Logger\Client\Factory;

use Elasticsearch\Client;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Logger\Client\ElasticsearchClientFacade;

/**
 * Class ElasticsearchClientFactory
 */
final class ElasticsearchClientFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return Client
     */
    public function __invoke(ContainerInterface $container): Client
    {
        $facade = new ElasticsearchClientFacade($container->get('config')['logger']['dataStore']['elasticsearch']);

        return $facade->getElasticsearchClient();
    }
}
