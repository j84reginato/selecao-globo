<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\View\Stage\Edition;

use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition\Championship;
use SelecaoGlobo\Infrastructure\Domain\View\AbstractView;

/**
 * Class ChampionshipView
 */
final class ChampionshipView extends AbstractView
{
    /**
     * @var Championship
     */
    private Championship $championship;

    /**
     * ChampionshipView constructor.
     *
     * @param Championship $championship
     */
    public function __construct(Championship $championship)
    {
        $this->championship = $championship;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'campeonato_id' => $this->championship->getId(),
            'nome'          => $this->championship->getName(),
            'slug'          => $this->championship->getSlug(),
            'genero'        => $this->championship->getGender(),
        ];
    }
}
