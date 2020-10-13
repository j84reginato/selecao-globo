<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\ValueObject\Stage\Edition;

use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition\Championship;
use SelecaoGlobo\Unit\Mocks\AbstractMock;

/**
 * Class ChampionshipMock
 */
class ChampionshipMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(Championship::class);
    }

    /**
     * @return Championship
     */
    public function getObjectWithMockDependencies(): Championship
    {
        return new Championship(26, 'Campeonato Brasileiro', 'campeonato-brasileiro', 'M');
    }
}
