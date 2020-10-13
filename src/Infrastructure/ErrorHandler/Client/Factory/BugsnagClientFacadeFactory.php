<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ErrorHandler\Client\Factory;

use Bugsnag;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\ErrorHandler\Client\BugsnagClientFacade;

/**
 * Class BugsnagClientFacadeFactory
 */
final class BugsnagClientFacadeFactory
{
    private const CONFIG_KEY = 'config';

    /**
     * @param ContainerInterface $container
     *
     * @return Bugsnag\Client
     */
    public function __invoke(ContainerInterface $container): Bugsnag\Client
    {
        $bugsnagConfig = $container->get(self::CONFIG_KEY)['errorHandler']['bugsnag'];

        $facade = new BugsnagClientFacade(
            (string)$bugsnagConfig['key'],
            (string)$container->get(self::CONFIG_KEY)['appRoot'],
            (string)$container->get(self::CONFIG_KEY)['environment'],
            (array)$bugsnagConfig['notify']
        );

        return $facade->getBugsnag();
    }
}
