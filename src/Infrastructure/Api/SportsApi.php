<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Api;

use GuzzleHttp\Client;

/**
 * class SportsApi
 */
class SportsApi
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var string
     */
    private string $baseUri;

    /**
     * @var int
     */
    private int $retryLimit;

    /**
     * SportsApi constructor.
     *
     * @param string $baseUri
     * @param int    $retryLimit
     */
    public function __construct(string $baseUri, int $retryLimit = 2)
    {
        $this->client     = new Client();
        $this->baseUri    = $baseUri;
        $this->retryLimit = $retryLimit;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @return int
     */
    public function getRetryLimit(): int
    {
        return $this->retryLimit;
    }
}
