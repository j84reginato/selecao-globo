<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Response\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Finder\MatchesFinder;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Hydrator\MatchesHydrator;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Response\ReadResponse;
use SelecaoGlobo\Infrastructure\Handler\API\ResponseInterface;

/**
 * Class ReadResponseFactory
 */
final class ReadResponseFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ResponseInterface
     */
    public function __invoke(ContainerInterface $container): ResponseInterface
    {
        return new ReadResponse(
            $container->get(MatchesFinder::class),
            $container->get(MatchesHydrator::class)
        );
    }
}
