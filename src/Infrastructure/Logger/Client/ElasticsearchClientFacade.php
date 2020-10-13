<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Logger\Client;

use Aws\Credentials\CredentialProvider;
use Aws\Credentials\Credentials;
use Aws\ElasticsearchService\ElasticsearchPhpHandler;
use Elasticsearch\Client as ElasticsearchClient;
use Elasticsearch\ClientBuilder;

/**
 * class ElasticsearchClientFacade
 */
final class ElasticsearchClientFacade
{
    /**
     * @var ElasticsearchClient
     */
    private ElasticsearchClient $elasticsearchClient;

    /**
     * ElasticsearchClientFacade constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $hosts = [
            $config['host']
        ];

        $client = ClientBuilder::create()
            ->setHosts($hosts)
            ->setRetries(3)
            ->build();

        $this->elasticsearchClient = $client;
    }

    /**
     * @return ElasticsearchClient
     */
    public function getElasticsearchClient(): ElasticsearchClient
    {
        return $this->elasticsearchClient;
    }
}
