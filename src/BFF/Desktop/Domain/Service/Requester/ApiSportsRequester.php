<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\Service\Requester;

use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use RuntimeException;
use SelecaoGlobo\BFF\Desktop\Domain\Exception\ApiCommunicationException;
use SelecaoGlobo\BFF\Desktop\Domain\Exception\MatchesNotFoundException;
use SelecaoGlobo\BFF\Desktop\Domain\Exception\RetryLimitException;
use SelecaoGlobo\Infrastructure\Api\SportsApi;
use SelecaoGlobo\Infrastructure\Cache\Manager\CacheManagerInterface;
use SelecaoGlobo\Infrastructure\Domain\Enums\SystemMessage;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;

/**
 * Class ApiSportsRequester
 */
class ApiSportsRequester
{
    private const PATH = 'esportes/futebol/modalidades/futebol_de_campo/categorias/profissional/data';

    /**
     * @var SportsApi
     */
    private SportsApi $client;

    /**
     * @var CacheManagerInterface
     */
    private CacheManagerInterface $cacheManager;

    /**
     * @var LoggerFacade
     */
    protected LoggerFacade $loggerFacade;

    /**
     * @var int
     */
    private static int $callCounter;

    /**
     * @var array
     */
    private array $cacheConfig;

    /**
     * ApiSportsRequester constructor.
     *
     * @param SportsApi             $client
     * @param CacheManagerInterface $cacheManager
     * @param LoggerFacade          $loggerFacade
     * @param array                 $cacheConfig
     */
    public function __construct(
        SportsApi $client,
        CacheManagerInterface $cacheManager,
        LoggerFacade $loggerFacade,
        array $cacheConfig
    ) {
        $this->client       = $client;
        $this->cacheManager = $cacheManager;
        $this->loggerFacade = $loggerFacade;
        $this->cacheConfig  = $cacheConfig;

        self::$callCounter = 0;
    }

    /**
     * @param string $param
     *
     * @return array
     */
    public function call(string $param): array
    {
        $path = self::PATH;
        $uri  = "{$this->client->getBaseUri()}/{$path}/{$param}/jogos";

        try {
            $response = $this->client->getClient()->get($uri);
            $this->loggerFacade->getLogger()->info("A call to esportes-API was processed");
            if (!$response) {
                throw new ApiCommunicationException('esportes-API', 400);
            }

            $statusCode = $response->getStatusCode();
            if ($statusCode === 404) {
                throw new MatchesNotFoundException();
            }

            if ($statusCode !== 200) {
                throw new RuntimeException(SystemMessage::UNKNOWN_ERROR, $statusCode);
            }

            $response = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
            if (!$response) {
                throw new RuntimeException(SystemMessage::UNKNOWN_ERROR, 400);
            }

            if ((bool)$this->cacheConfig['enabled']) {
                $this->cacheManager->setRegister(
                    sprintf($this->cacheConfig['matchesCacheKey'], $param),
                    $response,
                    (int)$this->cacheConfig['matchesCacheTime']
                );
            }
        } catch (ClientException | GuzzleException $e) {
            if ($e->getCode() === 404) {
                $this->loggerFacade->getLogger()->error($e->getMessage());
                throw new MatchesNotFoundException();
            }
        } catch (ApiCommunicationException | JsonException | RuntimeException | Exception $e) {
            $this->loggerFacade->getLogger()->error($e->getMessage());

            self::$callCounter++;
            if (self::$callCounter === $this->client->getRetryLimit()) {
                $this->loggerFacade->getLogger()->error('Call attempt limit has been reached');
                throw new RetryLimitException();
            }

            $this->call($param);
        }

        return $response ?? [];
    }
}
