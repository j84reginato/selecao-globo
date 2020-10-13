<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\ValueObject;

use DateTime;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition\Championship;

/**
 * Class Match
 */
class Match
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var DateTime
     */
    private DateTime $dateTime;

    /**
     * @var Team
     */
    private Team $homeTeam;

    /**
     * @var Team
     */
    private Team $visitingTeam;

    /**
     * @var Championship
     */
    private Championship $championship;

    /**
     * @var Edition
     */
    private Edition $edition;

    /**
     * @var Stage
     */
    private Stage $stage;

    /**
     * @var int
     */
    private int $round;

    /**
     * @var array
     */
    private array $winner;

    /**
     * @var int
     */
    private int $homeTeamOfficialScore;

    /**
     * @var int
     */
    private int $visitingTeamOfficialScore;

    /**
     * @var int
     */
    private int $homeTeamPenaltiesScore;

    /**
     * @var int
     */
    private int $visitingTeamPenaltiesScore;

    /**
     * @var bool
     */
    private bool $decisive;

    /**
     * @var bool
     */
    private bool $suspended;

    /**
     * @var bool
     */
    private bool $canceled;

    /**
     * @var bool
     */
    private bool $wo;

    /**
     * @var Stadium
     */
    private Stadium $stadium;

    /**
     * @var Lineup
     */
    private Lineup $homeTeamLineup;

    /**
     * @var Lineup
     */
    private Lineup $visitingTeamLineup;

    /**
     * Match constructor.
     *
     * @param int          $id
     * @param DateTime     $dateTime
     * @param Team         $homeTeam
     * @param Team         $visitingTeam
     * @param Championship $championship
     * @param Edition      $edition
     * @param Stage        $stage
     * @param int          $round
     * @param array        $winner
     * @param int          $homeTeamOfficialScore
     * @param int          $visitingTeamOfficialScore
     * @param int          $homeTeamPenaltiesScore
     * @param int          $visitingTeamPenaltiesScore
     * @param bool         $decisive
     * @param bool         $suspended
     * @param bool         $canceled
     * @param bool         $wo
     * @param Stadium      $stadium
     * @param Lineup       $homeTeamLineup
     * @param Lineup       $visitingTeamLineup
     */
    public function __construct(
        int $id,
        DateTime $dateTime,
        Team $homeTeam,
        Team $visitingTeam,
        Championship $championship,
        Edition $edition,
        Stage $stage,
        int $round,
        array $winner,
        int $homeTeamOfficialScore,
        int $visitingTeamOfficialScore,
        int $homeTeamPenaltiesScore,
        int $visitingTeamPenaltiesScore,
        bool $decisive,
        bool $suspended,
        bool $canceled,
        bool $wo,
        Stadium $stadium,
        Lineup $homeTeamLineup,
        Lineup $visitingTeamLineup
    ) {
        $this->id                         = $id;
        $this->dateTime                   = $dateTime;
        $this->homeTeam                   = $homeTeam;
        $this->visitingTeam               = $visitingTeam;
        $this->championship               = $championship;
        $this->edition                    = $edition;
        $this->stage                      = $stage;
        $this->round                      = $round;
        $this->winner                     = $winner;
        $this->homeTeamOfficialScore      = $homeTeamOfficialScore;
        $this->visitingTeamOfficialScore  = $visitingTeamOfficialScore;
        $this->homeTeamPenaltiesScore     = $homeTeamPenaltiesScore;
        $this->visitingTeamPenaltiesScore = $visitingTeamPenaltiesScore;
        $this->decisive                   = $decisive;
        $this->suspended                  = $suspended;
        $this->canceled                   = $canceled;
        $this->wo                         = $wo;
        $this->stadium                    = $stadium;
        $this->homeTeamLineup             = $homeTeamLineup;
        $this->visitingTeamLineup         = $visitingTeamLineup;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    /**
     * @return Team
     */
    public function getHomeTeam(): Team
    {
        return $this->homeTeam;
    }

    /**
     * @return Team
     */
    public function getVisitingTeam(): Team
    {
        return $this->visitingTeam;
    }

    /**
     * @return Championship
     */
    public function getChampionship(): Championship
    {
        return $this->championship;
    }

    /**
     * @return Edition
     */
    public function getEdition(): Edition
    {
        return $this->edition;
    }

    /**
     * @return Stage
     */
    public function getStage(): Stage
    {
        return $this->stage;
    }

    /**
     * @return int
     */
    public function getRound(): int
    {
        return $this->round;
    }

    /**
     * @return array
     */
    public function getWinner(): array
    {
        return $this->winner;
    }

    /**
     * @return int
     */
    public function getHomeTeamOfficialScore(): int
    {
        return $this->homeTeamOfficialScore;
    }

    /**
     * @return int
     */
    public function getVisitingTeamOfficialScore(): int
    {
        return $this->visitingTeamOfficialScore;
    }

    /**
     * @return int
     */
    public function getHomeTeamPenaltiesScore(): int
    {
        return $this->homeTeamPenaltiesScore;
    }

    /**
     * @return int
     */
    public function getVisitingTeamPenaltiesScore(): int
    {
        return $this->visitingTeamPenaltiesScore;
    }

    /**
     * @return bool
     */
    public function isDecisive(): bool
    {
        return $this->decisive;
    }

    /**
     * @return bool
     */
    public function isSuspended(): bool
    {
        return $this->suspended;
    }

    /**
     * @return bool
     */
    public function isCanceled(): bool
    {
        return $this->canceled;
    }

    /**
     * @return bool
     */
    public function isWo(): bool
    {
        return $this->wo;
    }

    /**
     * @return Stadium
     */
    public function getStadium(): Stadium
    {
        return $this->stadium;
    }

    /**
     * @return Lineup
     */
    public function getHomeTeamLineup(): Lineup
    {
        return $this->homeTeamLineup;
    }

    /**
     * @return Lineup
     */
    public function getVisitingTeamLineup(): Lineup
    {
        return $this->visitingTeamLineup;
    }
}
