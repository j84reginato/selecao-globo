<?php

namespace SelecaoGlobo\Infrastructure\Handler\API;

use DomainException;
use Exception;
use InvalidArgumentException;
use JsonException;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as ServerResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Exception\MatchesNotFoundException;
use SelecaoGlobo\Infrastructure\Domain\Enums\SystemMessage;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerInterface;

/**
 * Class AbstractHandler
 */
abstract class AbstractHandler
{
    /**
     * @var bool
     */
    protected static bool $debugMode = false;

    /**
     * @var RequestInterface
     */
    protected RequestInterface $appRequest;

    /**
     * @var ResponseInterface
     */
    protected ResponseInterface $appResponse;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $loggerFacade;

    /**
     * @var string
     */
    protected string $source;

    /**
     * @var int
     */
    protected int $successMessageCode;

    /**
     * @var string
     */
    protected string $successMessageParam;

    /**
     * @var int
     */
    protected int $successStatusCode;

    /**
     * @var bool
     */
    protected bool $isList = false;

    /**
     * AbstractAction constructor.
     *
     * @param RequestInterface  $appRequest
     * @param ResponseInterface $appResponse
     * @param LoggerFacade      $loggerFacade
     * @param bool              $debugMode
     */
    public function __construct(
        RequestInterface $appRequest,
        ResponseInterface $appResponse,
        LoggerFacade $loggerFacade,
        $debugMode = false
    ) {
        $this->appRequest   = $appRequest;
        $this->appResponse  = $appResponse;
        $this->loggerFacade = $loggerFacade;

        self::$debugMode = $debugMode;
    }

    /**
     * @param ServerRequestInterface $serverRequest
     *
     * @return ServerResponseInterface
     * @throws JsonException
     */
    public function handle(ServerRequestInterface $serverRequest): ServerResponseInterface
    {
        $context = [
            'source'     => $this->source,
            'attributes' => [
                'request-id' => $serverRequest->getAttribute('request-id'),
                'token'      => [
                    'iss' => $serverRequest->getAttribute('token')['iss'],
                    'exp' => $serverRequest->getAttribute('token')['exp'],
                    'sub' => $serverRequest->getAttribute('token')['sub'],
                    'aud' => $serverRequest->getAttribute('token')['aud'],
                    'iat' => $serverRequest->getAttribute('token')['iat'],
                ],
            ],
            'request'    => [
                'query_string' => $serverRequest->getUri()->getQuery() ?? json_encode([], JSON_THROW_ON_ERROR),
                'query_params' => $serverRequest->getQueryParams()
                    ? json_encode($serverRequest->getQueryParams(), JSON_THROW_ON_ERROR)
                    : json_encode([], JSON_THROW_ON_ERROR),
                'body'         => $serverRequest->getBody() && $serverRequest->getBody()->getContents()
                    ? $serverRequest->getBody()->getContents()
                    : json_encode([], JSON_THROW_ON_ERROR),
            ],
            'env'        => getenv('APPLICATION_ENV'),
        ];

        try {
            if (self::$debugMode) {
                $this->loggerFacade->getLogger()->info(sprintf('Request: %s', __METHOD__), $context);
            }

            $this->configNewRelic($this->source, json_encode($serverRequest->getQueryParams(), JSON_THROW_ON_ERROR));
            $request  = $this->appRequest->parse($serverRequest);
            $response = $this->appResponse->process($request);
        } catch (InvalidArgumentException $e) {
            $this->loggerFacade->getLogger()->error($e->getMessage(), $context);
            return $this->createErrorJsonResponse([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        } catch (MatchesNotFoundException $e) {
            $this->loggerFacade->getLogger()->error($e->getMessage(), $context);
            return $this->createErrorJsonResponse([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        } catch (DomainException $e) {
            $this->loggerFacade->getLogger()->error($e->getMessage(), $context);
            return $this->createErrorJsonResponse([
                'success' => false,
                'message' => $e->getMessage(),
            ], $e->getCode());
        } catch (Exception $e) {
            $this->loggerFacade->getLogger()->error($e->getMessage(), $context);
            return $this->createErrorJsonResponse([
                'success' => false,
                'message' => getenv('APPLICATION_ENV') !== 'production'
                    ? $e->getMessage()
                    : SystemMessage::getMessage(SystemMessage::INTERNAL_ERROR),
            ], $e->getCode());
        }

        if ($this->isList) {
            return $this->createJsonResponse($response, 200);
        }

        return $this->createJsonResponse([
            'success' => true,
            'message' => SystemMessage::getMessage($this->successMessageCode, $this->successMessageParam),
            'data'    => $response,
        ], $this->successStatusCode);
    }

    /**
     * @param string $source
     * @param string $parameters
     */
    protected function configNewRelic(string $source, string $parameters): void
    {
        if (!extension_loaded('newrelic')) {
            return;
        }

        newrelic_name_transaction($source);
        newrelic_add_custom_parameter('json', $parameters);
    }

    /**
     * @return void
     */
    protected function ignoreNewRelic(): void
    {
        if (extension_loaded('newrelic')) {
            newrelic_ignore_transaction();
        }
    }

    /**
     * @param array $data
     * @param int   $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function createJsonResponse(array $data, int $statusCode = 200, array $headers = []): JsonResponse
    {
        $statusCode = $statusCode && $statusCode >= 100 && $statusCode <= 599 ? $statusCode : 200;

        if (extension_loaded('newrelic')) {
            newrelic_end_of_transaction();
        }

        return new JsonResponse($data, $statusCode, $headers, JSON_PRETTY_PRINT);
    }

    /**
     * @param array $data
     * @param int   $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function createErrorJsonResponse(array $data, int $statusCode = 400, array $headers = []): JsonResponse
    {
        $statusCode = $statusCode && $statusCode >= 400 && $statusCode <= 599 ? $statusCode : 400;

        if (extension_loaded('newrelic')) {
            newrelic_end_of_transaction();
        }

        return new JsonResponse($data, $statusCode, $headers, JSON_PRETTY_PRINT);
    }
}
