<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\ValueObject;

/**
 * Class Team
 */
class Team
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
     * @var string
     */
    private string $slug;

    /**
     * @var string
     */
    private string $initials;

    /**
     * @var string
     */
    private string $nickname;

    /**
     * @var array
     */
    private array $badges;

    /**
     * @var array
     */
    private array $colors;

    /**
     * @var string
     */
    private string $gender;

    /**
     * Team constructor.
     *
     * @param int    $id
     * @param string $name
     * @param string $popularName
     * @param string $slug
     * @param string $initials
     * @param string $nickname
     * @param array  $badges
     * @param array  $colors
     * @param string $gender
     */
    public function __construct(
        int $id,
        string $name,
        string $popularName,
        string $slug,
        string $initials,
        string $nickname,
        array $badges,
        array $colors,
        string $gender
    ) {
        $this->id          = $id;
        $this->name        = $name;
        $this->popularName = $popularName;
        $this->slug        = $slug;
        $this->initials    = $initials;
        $this->nickname    = $nickname;
        $this->badges      = $badges;
        $this->colors      = $colors;
        $this->gender      = $gender;
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
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getInitials(): string
    {
        return $this->initials;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return array
     */
    public function getBadges(): array
    {
        return $this->badges;
    }

    /**
     * @return array
     */
    public function getColors(): array
    {
        return $this->colors;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }
}
