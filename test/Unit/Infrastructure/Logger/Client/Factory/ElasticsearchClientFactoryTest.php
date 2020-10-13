<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\Logger\Client\Factory;

use Exception;
use Prophecy\Prophecy\ProphecyInterface;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Logger\Client\Factory\ElasticsearchClientFactory;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class ElasticsearchClientFactory
 */
class ElasticsearchClientFactoryTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        /** @var ProphecyInterface|ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        $container->get('config')->willReturn(
            [
                'logger' => [
                    'dataStore' => [
                        'elasticsearch' => [
                            'host' => 'mock',
                        ],
                    ],
                ],
            ]
        );

        $this->container = $container->reveal();
    }

    /**
     * @return void
     */
    public function testInvoke(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $exception = null;
        try {
            (new ElasticsearchClientFactory())($this->container);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
