<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Action\Factory;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Action\ReadHandler;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Response\ReadResponse;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;

/**
 * Class ReadHandlerFactory
 */
final class ReadHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return RequestHandlerInterface
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        return new ReadHandler(
            $container->get(ReadRequest::class),
            $container->get(ReadResponse::class),
            $container->get(LoggerFacade::ELASTICSEARCH),
            $container->get('config')['debug'] ?? false
        );
    }
}
