<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition;

/**
 * Class Championship
 */
class Championship
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
    private string $gender;

    /**
     * Championship constructor.
     *
     * @param int    $id
     * @param string $name
     * @param string $slug
     * @param string $gender
     */
    public function __construct(
        int $id,
        string $name,
        string $slug,
        string $gender
    ) {
        $this->id     = $id;
        $this->name   = $name;
        $this->slug   = $slug;
        $this->gender = $gender;
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
    public function getGender(): string
    {
        return $this->gender;
    }
}
