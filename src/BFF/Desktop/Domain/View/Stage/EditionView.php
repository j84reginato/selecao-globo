<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\View\Stage;

use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition;
use SelecaoGlobo\BFF\Desktop\Domain\View\Stage\Edition\ChampionshipView;
use SelecaoGlobo\Infrastructure\Domain\View\AbstractView;

/**
 * Class EditionView
 */
final class EditionView extends AbstractView
{
    /**
     * @var Edition
     */
    private Edition $edition;

    /**
     * EditionView constructor.
     *
     * @param Edition $edition
     */
    public function __construct(Edition $edition)
    {
        $this->edition = $edition;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'edicao_id'      => $this->edition->getId(),
            'nome'           => $this->edition->getName(),
            'slug'           => $this->edition->getSlug(),
            'slug_editorial' => $this->edition->getEditorialSlug(),
            'campeonato'     => $this->edition->getChampionship()
                ? (new ChampionshipView($this->edition->getChampionship()))->serialize()
                : null,
        ];
    }
}
