<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\ValueObject;

/**
 * Class Stadium
 */
class Stadium
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
    private string $popularName;

    /**
     * @var array
     */
    private array $type;

    /**
     * Stadium constructor.
     *
     * @param int    $id
     * @param string $name
     * @param string $popularName
     * @param array  $type
     */
    public function __construct(
        int $id,
        string $name,
        string $popularName,
        array $type
    ) {
        $this->id          = $id;
        $this->name        = $name;
        $this->popularName = $popularName;
        $this->type        = $type;
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
    public function getPopularName(): string
    {
        return $this->popularName;
    }

    /**
     * @return array
     */
    public function getType(): array
    {
        return $this->type;
    }
}
