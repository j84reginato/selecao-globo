<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\ValueObject;

use DateTime;
use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stadium;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition\Championship;
use SelecaoGlobo\Unit\Mocks\AbstractMock;

/**
 * Class StageMock
 */
class StageMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(Stadium::class);
    }

    /**
     * @return Stage
     */
    public function getObjectWithMockDependencies(): Stage
    {
        $championship = new Championship(26, 'Campeonato Brasileiro', 'campeonato-brasileiro', 'M');

        $edition = new Edition(
            2757,
            'Campeonato Brasileiro 2019',
            'campeonato-brasileiro-2019',
            '2019',
            $championship
        );

        return new Stage(
            5896,
            'Fase única',
            'fase-unica-seriea-2019',
            new DateTime('2019-04-27 00:00:00'),
            new DateTime('2019-12-08 00:00:00'),
            true,
            1,
            '',
            [
                'tipo_id'   => '1',
                'descricao' => 'Pontos Corridos',
            ],
            [
                'descricao'  => 'Um jogo',
                'formato_id' => 0,
            ],
            $edition
        );
    }
}
