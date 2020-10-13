<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\ValueObject\Stage;

use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition\Championship;
use SelecaoGlobo\Unit\Mocks\AbstractMock;

/**
 * Class EditionMock
 */
class EditionMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(Edition::class);
    }

    /**
     * @return Edition
     */
    public function getObjectWithMockDependencies(): Edition
    {
        return new Edition(
            2757,
            'Campeonato Brasileiro 2019',
            'campeonato-brasileiro-2019',
            '2019',
            new Championship(26, 'Campeonato Brasileiro', 'campeonato-brasileiro', 'M')
        );
    }
}
