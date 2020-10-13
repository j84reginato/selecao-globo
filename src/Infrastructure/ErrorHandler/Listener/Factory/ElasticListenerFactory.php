<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ErrorHandler\Listener\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\ErrorHandler\Listener\ElasticListener;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;

/**
 * Class ElasticListenerFactory
 */
final class ElasticListenerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ElasticListener
     */
    public function __invoke(ContainerInterface $container): ElasticListener
    {
        return new ElasticListener(
            ($container->get(LoggerFacade::ELASTICSEARCH))->getLogger()
        );
    }
}
