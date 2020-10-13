<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\View;

use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Match;
use SelecaoGlobo\Infrastructure\Domain\View\AbstractView;

/**
 * Class MatchView
 */
final class MatchView extends AbstractView
{
    /**
     * @var Match
     */
    private Match $match;

    /**
     * MatchView constructor.
     *
     * @param Match $match
     */
    public function __construct(Match $match)
    {
        $this->match = $match;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'jogo_id'                   => $this->match->getId(),
            'data_hora_realizacao'      => $this->match->getDateTime(),
            'equipe_mandante'           => $this->match->getHomeTeam()
                ? (new TeamView($this->match->getHomeTeam()))->serialize()
                : null,
            'equipe_visitante'          => $this->match->getVisitingTeam()
                ? (new TeamView($this->match->getVisitingTeam()))->serialize()
                : null,
            'campeonato'                => $this->match->getStage()->getEdition()->getChampionship()->getName(),
            'edicao'                    => $this->match->getStage()->getEdition()->getName(),
            'fase'                      => $this->match->getStage()
                ? (new StageView($this->match->getStage()))->serialize()
                : null,
            'rodada'                    => $this->match->getRound(),
            'vencedor_jogo'             => $this->match->getWinner(),
            'placar_oficial_mandante'   => $this->match->getHomeTeamOfficialScore(),
            'placar_oficial_visitante'  => $this->match->getVisitingTeamOfficialScore(),
            'placar_penaltis_mandante'  => $this->match->getHomeTeamPenaltiesScore(),
            'placar_penaltis_visitante' => $this->match->getVisitingTeamPenaltiesScore(),
            'decisivo'                  => $this->match->isDecisive(),
            'suspenso'                  => $this->match->isSuspended(),
            'cancelado'                 => $this->match->isCanceled(),
            'wo'                        => $this->match->isWo(),
            'sede'                      => $this->match->getStadium()
                ? (new StadiumView($this->match->getStadium()))->serialize()
                : null,
            'escalacao_mandante'        => $this->match->getHomeTeamLineup()
                ? (new LineupView($this->match->getHomeTeamLineup()))->serialize()
                : null,
            'escalacao_visitante'       => $this->match->getVisitingTeamLineup()
                ? (new LineupView($this->match->getVisitingTeamLineup()))->serialize()
                : null,
        ];
    }
}
