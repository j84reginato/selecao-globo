<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Action\Factory;

use Exception;
use Prophecy\Prophecy\ProphecyInterface;
use Prophecy\Prophet;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Action\Factory\ReadHandlerFactory;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Response\ReadResponse;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class ReadHandlerFactoryTest
 */
class ReadHandlerFactoryTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        /** @var ProphecyInterface|ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        $container->get(ReadRequest::class)->willReturn(
            (new Prophet())->prophesize(ReadRequest::class)->reveal()
        );
        $container->get(ReadResponse::class)->willReturn(
            (new Prophet())->prophesize(ReadResponse::class)->reveal()
        );
        $container->get(LoggerFacade::ELASTICSEARCH)->willReturn(
            (new Prophet())->prophesize(LoggerFacade::class)->reveal()
        );
        $container->get('config')->willReturn(false);

        $this->container = $container->reveal();
    }

    /**
     * Test: OK
     *
     * @return void
     */
    public function testInvoke(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $exception = null;
        try {
            (new ReadHandlerFactory())($this->container);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
