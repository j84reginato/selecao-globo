<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\View;

use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stadium;
use SelecaoGlobo\Infrastructure\Domain\View\AbstractView;

/**
 * Class StadiumView
 */
final class StadiumView extends AbstractView
{
    /**
     * @var Stadium
     */
    private Stadium $stadium;

    /**
     * StadiumView constructor.
     *
     * @param Stadium $stadium
     */
    public function __construct(Stadium $stadium)
    {
        $this->stadium = $stadium;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'sede_id'      => $this->stadium->getId(),
            'nome'         => $this->stadium->getName(),
            'nome_popular' => $this->stadium->getPopularName(),
            'tipo'         => $this->stadium->getType(),
        ];
    }
}
