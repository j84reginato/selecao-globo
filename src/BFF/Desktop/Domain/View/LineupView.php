<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\View;

use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Lineup;
use SelecaoGlobo\Infrastructure\Domain\View\AbstractView;

/**
 * Class LineupView
 */
final class LineupView extends AbstractView
{
    /**
     * @var Lineup
     */
    private Lineup $lineup;

    /**
     * LineupView constructor.
     *
     * @param Lineup $lineup
     */
    public function __construct(Lineup $lineup)
    {
        $this->lineup = $lineup;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'escalacao_id' => $this->lineup->getId(),
        ];
    }
}
