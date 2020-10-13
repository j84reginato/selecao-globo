<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ErrorHandler\Listener;

use JsonException;
use Monolog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

/**
 * Class ElasticListener
 */
class ElasticListener
{
    /**
     * @var Monolog\Logger
     */
    private Monolog\Logger $logger;

    /**
     * ElasticListener constructor.
     *
     * @param Monolog\Logger $logger
     */
    public function __construct(Monolog\Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Throwable              $error
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     *
     * @throws JsonException
     */
    public function __invoke(Throwable $error, ServerRequestInterface $request, ResponseInterface $response)
    {
        $context = [
            'attributes' => [
                'request-id' => $request->getAttribute('request-id'),
                'token'      => [
                    'iss' => $request->getAttribute('token')['iss'],
                    'exp' => $request->getAttribute('token')['exp'],
                    'sub' => $request->getAttribute('token')['sub'],
                    'aud' => $request->getAttribute('token')['aud'],
                    'iat' => $request->getAttribute('token')['iat'],
                ],
            ],
            'request'    => [
                'query_string' => $request->getUri()->getQuery() ?? json_encode([], JSON_THROW_ON_ERROR),
                'query_params' => $request->getQueryParams()
                    ? json_encode($request->getQueryParams(), JSON_THROW_ON_ERROR)
                    : json_encode([], JSON_THROW_ON_ERROR),

                'body' => $request->getBody()->isReadable()
                    ? $request->getBody()->read(5000)
                    : json_encode([], JSON_THROW_ON_ERROR),
            ],
            'env'        => getenv('APPLICATION_ENV'),
            'error'      => $error->getMessage(),
            'traceback'  => $error->getTraceAsString(),
        ];

        $this->logger->error("Error on HTTP Request: " . $request->getUri()->getPath(), $context);
    }
}
