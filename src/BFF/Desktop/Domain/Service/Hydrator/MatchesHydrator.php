<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\Service\Hydrator;

use DateTime;
use Exception;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Lineup;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Match;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stadium;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition\Championship;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Team;

/**
 * Class MatchesHydrator
 */
class MatchesHydrator
{
    /**
     * @var array
     */
    private static array $references;

    /**
     * @param array $matches
     * @param array $references
     *
     * @return mixed
     * @throws Exception
     */
    public function hydrate(array $matches, array $references): array
    {
        self::$references = $references;

        return array_map(function ($data): Match {
            return $this->serialize($data);
        }, $matches);
    }

    /**
     * @param mixed[] $data
     *
     * @return Match
     * @throws Exception
     */
    private function serialize(array $data): Match
    {
        $homeTeam           = $this->buildTeam((int)$data['equipe_mandante_id']);
        $visitingTeam       = $this->buildTeam((int)$data['equipe_visitante_id']);
        $championship       = $this->buildChampionship((int)$data['fase_id']);
        $edition            = $this->buildEdition((int)$data['fase_id'], $championship);
        $stage              = $this->buildStage((int)$data['fase_id'], $edition);
        $stadium            = $this->buildStadium((int)$data['sede_id']);
        $homeTeamLineup     = $this->buildLineup((int)$data['escalacao_mandante_id'], 'escalacao_mandante');
        $visitingTeamLineup = $this->buildLineup((int)$data['escalacao_visitante_id'], 'escalacao_visitante');

        return new Match(
            $data['jogo_id'],
            new DateTime($data['data_realizacao'] . ' ' . $data['hora_realizacao']),
            $homeTeam,
            $visitingTeam,
            $championship,
            $edition,
            $stage,
            (int)$data['rodada'],
            (array)$data['vencedor_jogo'],
            (int)$data['placar_oficial_mandante'],
            (int)$data['placar_oficial_visitante'],
            (int)$data['placar_penaltis_mandante'],
            (int)$data['placar_penaltis_visitante'],
            (bool)$data['decisivo'],
            (bool)$data['suspenso'],
            (bool)$data['cancelado'],
            (bool)$data['wo'],
            $stadium,
            $homeTeamLineup,
            $visitingTeamLineup
        );
    }

    /**
     * @param int $id
     *
     * @return Team
     */
    private function buildTeam(int $id): Team
    {
        return new Team(
            (int)self::$references['equipes'][$id]['equipe_id'],
            (string)self::$references['equipes'][$id]['nome'],
            (string)self::$references['equipes'][$id]['nome_popular'],
            (string)self::$references['equipes'][$id]['slug'],
            (string)self::$references['equipes'][$id]['sigla'],
            (string)self::$references['equipes'][$id]['apelido'],
            (array)self::$references['equipes'][$id]['escudos'],
            (array)self::$references['equipes'][$id]['cores'],
            (string)self::$references['equipes'][$id]['genero'],
        );
    }

    /**
     * @param int $stageId
     *
     * @return Championship
     */
    private function buildChampionship(int $stageId): Championship
    {
        $editionId      = (int)self::$references['fases'][$stageId]['edicao_id'];
        $championshipId = (int)self::$references['edicoes'][$editionId]['campeonato_id'];

        return new Championship(
            (int)self::$references['campeonatos'][$championshipId]['campeonato_id'],
            (string)self::$references['campeonatos'][$championshipId]['nome'],
            (string)self::$references['campeonatos'][$championshipId]['slug'],
            (string)self::$references['campeonatos'][$championshipId]['genero'],
        );
    }

    /**
     * @param int          $stageId
     * @param Championship $championship
     *
     * @return Edition
     */
    private function buildEdition(int $stageId, Championship $championship): Edition
    {
        $editionId = (int)self::$references['fases'][$stageId]['edicao_id'];

        return new Edition(
            (int)self::$references['edicoes'][$editionId]['edicao_id'],
            (string)self::$references['edicoes'][$editionId]['nome'],
            (string)self::$references['edicoes'][$editionId]['slug'],
            (string)self::$references['edicoes'][$editionId]['slug_editorial'],
            $championship,
        );
    }

    /**
     * @param int     $stageId
     * @param Edition $edition
     *
     * @return Stage
     * @throws Exception
     */
    private function buildStage(int $stageId, Edition $edition): Stage
    {
        return new Stage(
            (int)self::$references['fases'][$stageId]['fase_id'],
            (string)self::$references['fases'][$stageId]['nome'],
            (string)self::$references['fases'][$stageId]['slug'],
            self::$references['fases'][$stageId]['data_inicio']
                ? new DateTime(self::$references['fases'][$stageId]['data_inicio'])
                : null,
            self::$references['fases'][$stageId]['data_fim']
                ? new DateTime(self::$references['fases'][$stageId]['data_fim'])
                : null,
            (bool)self::$references['fases'][$stageId]['atual'],
            (int)self::$references['fases'][$stageId]['ordem'],
            (string)self::$references['fases'][$stageId]['disclaimer'],
            (array)self::$references['fases'][$stageId]['tipo'],
            (array)self::$references['fases'][$stageId]['formato'],
            $edition,
        );
    }

    /**
     * @param int $id
     *
     * @return Stadium
     */
    private function buildStadium(int $id): Stadium
    {
        return new Stadium(
            (int)self::$references['sedes'][$id]['sede_id'],
            (string)self::$references['sedes'][$id]['nome'],
            (string)self::$references['sedes'][$id]['nome_popular'],
            (array)self::$references['sedes'][$id]['tipo']
        );
    }

    /**
     * @param int    $id
     * @param string $slug
     *
     * @return Lineup
     */
    private function buildLineup(int $id, string $slug): Lineup
    {
        return new Lineup(
            (int)(self::$references[$slug][$id][$slug . '_id'] ?? 0),
        );
    }
}
