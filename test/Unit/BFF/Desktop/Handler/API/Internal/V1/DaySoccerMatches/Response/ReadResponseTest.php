<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Response;

use Exception;
use JsonException;
use Prophecy\Doubler\DoubleInterface;
use Prophecy\Prophecy\ProphecyInterface;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Response\ReadResponse;
use SelecaoGlobo\Infrastructure\Handler\API\RequestInterface;
use SelecaoGlobo\Unit\AbstractUnitTestCase;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Response\ReadResponseMock;

/**
 * Class ReadResponseTest
 */
class ReadResponseTest extends AbstractUnitTestCase
{
    /**
     * @var ReadResponse
     */
    protected ReadResponse $response;

    /**
     * @var ProphecyInterface|RequestInterface
     */
    protected $request;

    /**
     * @return void
     * @throws JsonException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->response = (new ReadResponseMock($this->loggerFacade))->getObjectWithMockDependencies();
        $this->request  = $this->prophesize(RequestInterface::class);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testProcess(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        /** @var DoubleInterface|RequestInterface $request */
        $request = $this->request->reveal();

        $response = $this->response->process($request);

        static::assertNotNull($response);
    }
}
