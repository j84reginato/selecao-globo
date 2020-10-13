<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit;

use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Prophecy\Doubler\DoubleInterface;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;
use SelecaoGlobo\Unit\Helpers\ConsoleLoggerHelper;

/**
 * Class AbstractUnitTestCase
 */
abstract class AbstractUnitTestCase extends TestCase
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var LoggerFacade
     */
    protected LoggerFacade $loggerFacade;

    /**
     * @var DoubleInterface|ContainerInterface
     */
    protected $container;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $container = $this->prophesize(ContainerInterface::class);
        $container->get(LoggerFacade::ELASTICSEARCH)->willReturn(
            ConsoleLoggerHelper::getLogger()
        );
        $container->get('config')->willReturn(
            [
                'logger' => [
                    'dataStore' => [
                        'console' => [
                            'level'      => "debug",
                            'streamName' => 'console',
                        ],
                    ],
                ],
            ]
        );

        $this->container = $container->reveal();

        $this->logger       = $this->container->get(LoggerFacade::ELASTICSEARCH);
        $this->loggerFacade = new LoggerFacade($this->container, LoggerFacade::CONSOLE);
    }
}
