<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request;

use Prophecy\Doubler\DoubleInterface;
use Prophecy\Prophecy\ProphecyInterface;
use Psr\Http\Message\ServerRequestInterface;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;
use SelecaoGlobo\Unit\AbstractUnitTestCase;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequestMock;

/**
 * Class ReadRequestTest
 */
class ReadRequestTest extends AbstractUnitTestCase
{
    /**
     * @var ReadRequest
     */
    protected ReadRequest $request;

    /**
     * @var ProphecyInterface|ServerRequestInterface
     */
    protected $serverRequest;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->request       = (new ReadRequestMock($this->loggerFacade))->getObjectWithMockDependencies();
        $this->serverRequest = $this->prophesize(ServerRequestInterface::class);
    }

    /**
     * @dataProvider getData
     *
     * @param string $data
     */
    public function testParse(string $data): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $this->serverRequest->getAttribute('date')->willReturn($data);

        /** @var DoubleInterface|ServerRequestInterface $serverRequest */
        $serverRequest = $this->serverRequest->reveal();

        $this->request->parse($serverRequest);

        static::assertNotNull($this->request->getAttribute());
    }

    /**
     * @return string[]
     */
    public function getData(): array
    {
        return [
            [
                '2019-01-01',
            ],
        ];
    }
}
