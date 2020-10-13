<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\API\Internal;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class AliveHandler
 */
final class AliveHandler implements RequestHandlerInterface
{
    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (extension_loaded('newrelic')) {
            newrelic_ignore_transaction();
        }

        return new JsonResponse(
            [
                'ack'     => time(),
                'welcome' => 'Congratulations! It works',
                'docsUrl' => 'http://localhost:8181/documentation',
            ],
            200,
            [],
            JSON_PRETTY_PRINT
        );
    }
}
