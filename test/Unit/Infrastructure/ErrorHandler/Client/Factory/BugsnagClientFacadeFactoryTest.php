<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\ErrorHandler\Client\Factory;

use Exception;
use Prophecy\Prophecy\ProphecyInterface;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\ErrorHandler\Client\Factory\BugsnagClientFacadeFactory;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class BugsnagClientFacadeFactoryTest
 */
class BugsnagClientFacadeFactoryTest extends AbstractUnitTestCase
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
                'appRoot'      => 'mock',
                'environment'  => 'mock',
                'errorHandler' => [
                    'bugsnag' => [
                        'key'    => 'mock',
                        'notify' => 'mock',
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
            (new BugsnagClientFacadeFactory())($this->container);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
