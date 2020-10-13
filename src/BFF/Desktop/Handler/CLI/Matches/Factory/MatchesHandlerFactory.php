<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\CLI\Matches\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Finder\MatchesFinder;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;
use SelecaoGlobo\BFF\Desktop\Handler\CLI\Matches\MatchesHandler;

/**
 * Class MatchesHandlerFactory
 */
final class MatchesHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return MatchesHandler
     */
    public function __invoke(ContainerInterface $container): MatchesHandler
    {
        return new MatchesHandler(
            $container->get(ReadRequest::class),
            $container->get(MatchesFinder::class)
        );
    }
}
