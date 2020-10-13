<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Logger\Logger;

use Monolog\Handler\BufferHandler;
use Monolog\Handler\ElasticsearchHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Processor\WebProcessor;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Logger\Client\ElasticsearchClientFacade;
use SelecaoGlobo\Infrastructure\Logger\Formatter\ConsoleFormatter;
use SelecaoGlobo\Infrastructure\Logger\Processor\XRequestIdProcessor;

/**
 * Interface LoggerFacade
 */
class LoggerFacade implements LoggerInterface
{
    public const  ELASTICSEARCH = 'ElasticsearchLogger';
    public const  CONSOLE       = 'ConsoleLogger';

    /**
     * @var int
     */
    public int $logLevel = Logger::DEBUG;

    /**
     * @var Logger
     */
    private Logger $logger;

    /**
     * LoggerFacade constructor.
     *
     * @param ContainerInterface $container
     * @param string             $mode
     */
    public function __construct(ContainerInterface $container, string $mode)
    {
        $this->logger = new Logger('globo-bff');

        $this->logger->pushProcessor(new XRequestIdProcessor());
        $this->logger->pushProcessor(new ProcessIdProcessor());
        $this->logger->pushProcessor(new MemoryUsageProcessor());
        $this->logger->pushProcessor(new MemoryPeakUsageProcessor());
        $this->logger->pushProcessor(new WebProcessor());

        $this->config($container, $mode);
    }

    /**
     * @param ContainerInterface $container
     * @param string             $mode
     */
    private function config(ContainerInterface $container, string $mode = self::ELASTICSEARCH): void
    {
        switch ($mode) {
            case self::ELASTICSEARCH:
                $this->configElasticsearchLogger($container);
                break;
            case self::CONSOLE:
                $this->configConsoleLogger($container);
                break;
        }
    }

    /**
     * @param ContainerInterface $container
     */
    private function configElasticsearchLogger(ContainerInterface $container): void
    {
        $options = [
            'index' => $container->get('config')['logger']['dataStore']['elasticsearch']['index'],
        ];

        $client = $container->get(ElasticsearchClientFacade::class);

        $streamHandler = new ElasticsearchHandler($client, $options, $this->logLevel);
        $handler       = new BufferHandler($streamHandler, 100, $this->logLevel, true, true);
        $this->logger->pushHandler($handler);
    }

    /**
     * @param ContainerInterface $container
     */
    private function configConsoleLogger(ContainerInterface $container): void
    {
        $config = $container->get('config')['logger']['dataStore']['console'];

        $level = Logger::toMonologLevel($config['level']);

        $this->logger = new Logger($config['streamName']);

        $handler = new StreamHandler('php://output', $level);
        $handler->setFormatter(new ConsoleFormatter());
        $this->logger->pushHandler($handler);
    }

    /**
     * @return Logger
     */
    public function getLogger(): Logger
    {
        return $this->logger;
    }
}
