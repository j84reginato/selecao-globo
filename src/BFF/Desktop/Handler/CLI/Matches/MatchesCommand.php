<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\CLI\Matches;

use SelecaoGlobo\Infrastructure\ServiceBus\Command\CommandInterface;

/**
 * Class MatchesCommand
 */
final class MatchesCommand implements CommandInterface
{
    /**
     * @var string
     */
    private string $initialDate;

    /**
     * @var string
     */
    private string $finalDate;

    /**
     * MatchesCommand constructor.
     *
     * @param string $initialDate
     * @param string $finalDate
     */
    public function __construct(
        string $initialDate,
        string $finalDate
    ) {
        $this->initialDate = $initialDate;
        $this->finalDate   = $finalDate;
    }

    /**
     * @return string
     */
    public function getInitialDate(): string
    {
        return $this->initialDate;
    }

    /**
     * @return string
     */
    public function getFinalDate(): string
    {
        return $this->finalDate;
    }

    /**
     * @param array $data
     *
     * @return MatchesCommand
     */
    public static function fromArray(array $data): MatchesCommand
    {
        return new self(
            (string)$data['initialDate'],
            (string)$data['finalDate']
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'initialDate' => $this->initialDate,
            'finalDate'   => $this->finalDate,
        ];
    }
}
