<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Action;

use JsonException;
use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Action\ReadHandler;
use SelecaoGlobo\Unit\Mocks\AbstractMock;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequestMock;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Response\ReadResponseMock;

/**
 * Class ReadHandlerMock
 */
class ReadHandlerMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(ReadHandler::class);
    }

    /**
     * @return ReadHandler
     * @throws JsonException
     */
    public function getObjectWithMockDependencies(): ReadHandler
    {
        $appRequest  = (new ReadRequestMock($this->loggerFacade))->getObjectWithMockDependencies();
        $appResponse = (new ReadResponseMock($this->loggerFacade))->getObjectWithMockDependencies();

        return new ReadHandler($appRequest, $appResponse, $this->loggerFacade);
    }
}
