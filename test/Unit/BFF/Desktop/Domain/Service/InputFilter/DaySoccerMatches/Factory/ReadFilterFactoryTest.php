<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches\Factory;

use Exception;
use Prophecy\Prophecy\ProphecyInterface;
use Prophecy\Prophet;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches\Factory\ReadFilterFactory;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class ReadFilterFactoryTest
 */
class ReadFilterFactoryTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        /** @var ProphecyInterface|ContainerInterface $container */
        $container = $this->prophesize(ContainerInterface::class);

        $container->get(LoggerFacade::ELASTICSEARCH)->willReturn(
            (new Prophet())->prophesize(LoggerFacade::class)->reveal()
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
            (new ReadFilterFactory())($this->container);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
