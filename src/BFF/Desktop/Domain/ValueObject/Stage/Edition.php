<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage;

use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition\Championship;

/**
 * Class Edition
 */
class Edition
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $slug;

    /**
     * @var string
     */
    private string $editorialSlug;

    /**
     * @var Championship
     */
    private Championship $championship;

    /**
     * Edition constructor.
     *
     * @param int          $id
     * @param string       $name
     * @param string       $slug
     * @param string       $editorialSlug
     * @param Championship $championship
     */
    public function __construct(
        int $id,
        string $name,
        string $slug,
        string $editorialSlug,
        Championship $championship
    ) {
        $this->id            = $id;
        $this->name          = $name;
        $this->slug          = $slug;
        $this->editorialSlug = $editorialSlug;
        $this->championship  = $championship;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getEditorialSlug(): string
    {
        return $this->editorialSlug;
    }

    /**
     * @return Championship
     */
    public function getChampionship(): Championship
    {
        return $this->championship;
    }
}
