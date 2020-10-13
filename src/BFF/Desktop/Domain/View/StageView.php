<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\View;

use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage;
use SelecaoGlobo\BFF\Desktop\Domain\View\Stage\EditionView;
use SelecaoGlobo\Infrastructure\Domain\View\AbstractView;

/**
 * Class StageView
 */
final class StageView extends AbstractView
{
    /**
     * @var Stage
     */
    private Stage $stage;

    /**
     * StageView constructor.
     *
     * @param Stage $stage
     */
    public function __construct(Stage $stage)
    {
        $this->stage = $stage;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'fase_id'     => $this->stage->getId(),
            'nome'        => $this->stage->getName(),
            'slug'        => $this->stage->getSlug(),
            'data_inicio' => $this->stage->getInitialDate(),
            'data_fim'    => $this->stage->getFinalDate(),
            'atual'       => $this->stage->isCurrent(),
            'ordem'       => $this->stage->getOrder(),
            'disclaimer'  => $this->stage->getDisclaimer(),
            'tipo'        => $this->stage->getType(),
            'formato'     => $this->stage->getFormat(),
            'edicao'      => $this->stage->getEdition()
                ? (new EditionView($this->stage->getEdition()))->serialize()
                : null,

        ];
    }
}
