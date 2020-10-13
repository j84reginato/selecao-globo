<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches;

use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Finder\MatchesFinder;
use SelecaoGlobo\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches\ReadFilter;
use SelecaoGlobo\Unit\Mocks\AbstractMock;

/**
 * Class ReadFilterMock
 */
class ReadFilterMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(MatchesFinder::class);
    }

    /**
     * @return ReadFilter
     */
    public function getObjectWithMockDependencies(): ReadFilter
    {
        return new ReadFilter($this->loggerFacade);
    }
}
