<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\ValueObject;

use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stadium;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Team;
use SelecaoGlobo\Unit\Mocks\AbstractMock;

/**
 * Class TeamMock
 */
class TeamMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(Stadium::class);
    }

    /**
     * @return Team
     */
    public function getObjectWithMockDependencies(): Team
    {
        return new Team(
            262,
            'Clube de Regatas do Flamengo',
            'Flamengo',
            'flamengo',
            'FLA',
            'Flamengo',
            [
                '60x60' => 'https://s.glbimg.com/es/sde/f/organizacoes/2018/04/09/Flamengo-65.png',
                '30x30' => 'https://s.glbimg.com/es/sde/f/organizacoes/2018/04/09/Flamengo-30.png',
                'svg'   => 'https://s.glbimg.com/es/sde/f/organizacoes/2018/04/10/Flamengo-2018.svg',
                '45x45' => 'https://s.glbimg.com/es/sde/f/organizacoes/2018/04/09/Flamengo-45.png',
            ],
            [
                'terciaria'  => '#000000',
                'secundaria' => '#000000',
                'primaria'   => '#dd0000',
            ],
            'M'
        );
    }
}
