<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\ValueObject;

use DateTime;
use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Lineup;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Match;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stadium;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition\Championship;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Team;
use SelecaoGlobo\Unit\Mocks\AbstractMock;

/**
 * Class MatchMock
 */
class MatchMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(Match::class);
    }

    /**
     * @return Match
     */
    public function getObjectWithMockDependencies(): Match
    {
        $homeTeam = new Team(
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

        $visitingTeam = new Team(
            283,
            'Cruzeiro Esporte Clube',
            'Cruzeiro',
            'cruzeiro',
            'CRU',
            'Cruzeiro',
            [
                '60x60' => 'https://s.glbimg.com/es/sde/f/organizacoes/2018/04/09/cruzeiro-65.png',
                '30x30' => 'https://s.glbimg.com/es/sde/f/organizacoes/2018/04/09/cruzeiro-30.png',
                'svg'   => 'https://s.glbimg.com/es/sde/f/organizacoes/2018/04/10/cruzeiro-2018.svg',
                '45x45' => 'https://s.glbimg.com/es/sde/f/organizacoes/2018/04/09/cruzeiro-45.png',
            ],
            [
                'terciaria'  => '#000000',
                'secundaria' => '#ffffff',
                'primaria'   => '#1c498e',
            ],
            'M'
        );

        $championship = new Championship(26, 'Campeonato Brasileiro', 'campeonato-brasileiro', 'M');

        $edition = new Edition(
            2757,
            'Campeonato Brasileiro 2019',
            'campeonato-brasileiro-2019',
            '2019',
            new Championship(26, 'Campeonato Brasileiro', 'campeonato-brasileiro', 'M')
        );

        $stage = new Stage(
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

        $stadium = new Stadium(
            277,
            'Estádio Jornalista Mário Filho',
            'Maracanã',
            [
                'tipo_id'   => '1',
                'descricao' => 'Arena Desportiva',
            ]
        );

        $winner = [
            'equipe_id' => 262,
            'label'     => 'mandante',
        ];

        return new Match(
            232419,
            new DateTime('2019-04-27 21:00:00'),
            $homeTeam,
            $visitingTeam,
            $championship,
            $edition,
            $stage,
            1,
            $winner,
            3,
            1,
            0,
            0,
            false,
            false,
            false,
            false,
            $stadium,
            new Lineup(0),
            new Lineup(0)
        );
    }
}
