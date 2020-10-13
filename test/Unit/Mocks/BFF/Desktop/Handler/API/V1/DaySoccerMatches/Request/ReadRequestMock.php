<?php

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request;

use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Domain\Service\InputValidator\DaySoccerMatches\ReadValidator;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;
use SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Iterator\Common\CommonInputFilterIterator;
use SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Iterator\Common\CommonInputValidatorIterator;
use SelecaoGlobo\Unit\Mocks\AbstractMock;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches\ReadFilterMock;

/**
 * Class ReadRequestMock
 */
class ReadRequestMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        /** @var ObjectProphecy|ReadRequest $readRequest */
        $readRequest = $this->prophesize(ReadRequest::class);
        $readRequest->getAttribute()->will(function () {
            return '2019-01-01';
        });

        return $readRequest;
    }

    /**
     * @return ReadRequest
     */
    public function getObjectWithMockDependencies(): ReadRequest
    {
        $filterInput = new CommonInputFilterIterator([]);
        $filterInput->addFilter((new ReadFilterMock($this->loggerFacade))->getObjectWithMockDependencies());

        $validatorIterator = new CommonInputValidatorIterator([]);
        $validatorIterator->addValidator(new ReadValidator($this->loggerFacade));

        return new ReadRequest($filterInput, $validatorIterator);
    }
}
