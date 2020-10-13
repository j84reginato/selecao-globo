<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\ValueObject;

use DateTime;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stage\Edition;

/**
 * Class Stage
 */
class Stage
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
     * @var DateTime|null
     */
    private ?DateTime $initialDate;

    /**
     * @var DateTime|null
     */
    private ?DateTime $finalDate;

    /**
     * @var bool
     */
    private bool $current;

    /**
     * @var int
     */
    private int $order;

    /**
     * @var string
     */
    private string $disclaimer;

    /**
     * @var array
     */
    private array $type;

    /**
     * @var array
     */
    private array $format;

    /**
     * @var Edition
     */
    private Edition $edition;

    /**
     * Stage constructor.
     *
     * @param int           $id
     * @param string        $name
     * @param string        $slug
     * @param DateTime|null $initialDate
     * @param DateTime|null $finalDate
     * @param bool          $current
     * @param int           $order
     * @param string        $disclaimer
     * @param array         $type
     * @param array         $format
     * @param Edition       $edition
     */
    public function __construct(
        int $id,
        string $name,
        string $slug,
        ?DateTime $initialDate,
        ?DateTime $finalDate,
        bool $current,
        int $order,
        string $disclaimer,
        array $type,
        array $format,
        Edition $edition
    ) {
        $this->id          = $id;
        $this->name        = $name;
        $this->slug        = $slug;
        $this->initialDate = $initialDate;
        $this->finalDate   = $finalDate;
        $this->current     = $current;
        $this->order       = $order;
        $this->disclaimer  = $disclaimer;
        $this->type        = $type;
        $this->format      = $format;
        $this->edition     = $edition;
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
     * @return DateTime|null
     */
    public function getInitialDate(): ?DateTime
    {
        return $this->initialDate;
    }

    /**
     * @return DateTime|null
     */
    public function getFinalDate(): ?DateTime
    {
        return $this->finalDate;
    }

    /**
     * @return bool
     */
    public function isCurrent(): bool
    {
        return $this->current;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getDisclaimer(): string
    {
        return $this->disclaimer;
    }

    /**
     * @return array
     */
    public function getType(): array
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getFormat(): array
    {
        return $this->format;
    }

    /**
     * @return Edition
     */
    public function getEdition(): Edition
    {
        return $this->edition;
    }
}
