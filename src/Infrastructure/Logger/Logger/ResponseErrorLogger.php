<?php

namespace SelecaoGlobo\Infrastructure\Logger\Logger;

use Monolog\Logger;
use PhpMiddleware\RequestId\RequestIdMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class ResponseErrorLogger
 */
class ResponseErrorLogger implements MiddlewareInterface
{
    /**
     * @var Logger
     */
    private Logger $logger;

    /**
     * ResponseErrorLoggerMiddleware constructor.
     *
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uri     = $request->getUri();
        $path    = $uri->getPath();
        $method  = $request->getMethod();
        $version = $request->getProtocolVersion();

        $this->logger->info("{$method} {$path} HTTP/{$version}", [
            'context' => 'http.request',
            'uri'     => (string)$uri,
            'request' => [
                'id'      => $request->getAttribute(RequestIdMiddleware::ATTRIBUTE_NAME),
                'body'    => $request->getBody()->getContents(),
                'headers' => $request->getHeaders(),
            ],
        ]);

        $response = $handler->handle($request);

        $statusCode     = $response->getStatusCode();
        $responseLogger = [$this->logger, $statusCode < 300 ? 'info' : 'error'];
        $body           = $response->getBody();
        $contents       = ($body->isReadable() && $body->getSize() < 1000)
            ? $body->getContents()
            : "Resposta muito longa";

        $responseLogger("HTTP/{$version} {$statusCode} {$path}", [
            'url'         => (string)$request->getUri(),
            'status_code' => $response->getStatusCode(),
            'request'     => [
                'id' => $request->getAttribute(RequestIdMiddleware::ATTRIBUTE_NAME),
            ],
            'response'    => [
                'body' => $contents,
            ],
        ]);

        return $response;
    }
}
