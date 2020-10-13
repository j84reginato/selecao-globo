<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ErrorHandler\Listener\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\ErrorHandler\Client\BugsnagClientFacade;
use SelecaoGlobo\Infrastructure\ErrorHandler\Listener\BugsnagListener;

/**
 * Class BugsnagListenerFactory
 */
final class BugsnagListenerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return BugsnagListener
     */
    public function __invoke(ContainerInterface $container): BugsnagListener
    {
        return new BugsnagListener(
            $container->get(BugsnagClientFacade::class)
        );
    }
}
