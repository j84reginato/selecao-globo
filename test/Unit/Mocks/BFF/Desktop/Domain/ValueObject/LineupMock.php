<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\ValueObject;

use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Lineup;
use SelecaoGlobo\Unit\Mocks\AbstractMock;

/**
 * Class LineupMock
 */
class LineupMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(Lineup::class);
    }

    /**
     * @return Lineup
     */
    public function getObjectWithMockDependencies(): Lineup
    {
        return new Lineup(0);
    }
}
