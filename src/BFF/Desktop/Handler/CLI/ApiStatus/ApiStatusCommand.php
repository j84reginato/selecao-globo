<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\CLI\ApiStatus;

use SelecaoGlobo\Infrastructure\ServiceBus\Command\CommandInterface;

/**
 * Class ApiStatusCommand
 */
final class ApiStatusCommand implements CommandInterface
{
    /**
     * @var string
     */
    private string $message;

    /**
     * ApiStatusCommand constructor.
     *
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param array $data
     *
     * @return ApiStatusCommand
     */
    public static function fromArray(array $data): ApiStatusCommand
    {
        return new self(
            $data['message']
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'message' => $this->message,
        ];
    }
}
