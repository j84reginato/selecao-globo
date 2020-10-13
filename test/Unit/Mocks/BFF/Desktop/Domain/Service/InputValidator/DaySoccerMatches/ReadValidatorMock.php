<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\InputValidator\DaySoccerMatches;

use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Domain\Service\InputValidator\DaySoccerMatches\ReadValidator;
use SelecaoGlobo\Unit\Mocks\AbstractMock;

/**
 * Class ReadValidatorMock
 */
class ReadValidatorMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(ReadValidator::class);
    }

    /**
     * @return ReadValidator
     */
    public function getObjectWithMockDependencies(): ReadValidator
    {
        return new ReadValidator($this->loggerFacade);
    }
}
