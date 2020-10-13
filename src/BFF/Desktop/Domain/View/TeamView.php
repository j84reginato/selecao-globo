<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\View;

use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Team;
use SelecaoGlobo\Infrastructure\Domain\View\AbstractView;

/**
 * Class TeamView
 */
final class TeamView extends AbstractView
{
    /**
     * @var Team
     */
    private Team $team;

    /**
     * TeamView constructor.
     *
     * @param Team $team
     */
    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'equipe_id'    => $this->team->getId(),
            'nome'         => $this->team->getName(),
            'nome_popular' => $this->team->getPopularName(),
            'slug'         => $this->team->getSlug(),
            'sigla'        => $this->team->getInitials(),
            'apelido'      => $this->team->getNickname(),
            'escudos'      => $this->team->getBadges(),
            'cores'        => $this->team->getColors(),
            'genero'       => $this->team->getGender(),
        ];
    }
}
