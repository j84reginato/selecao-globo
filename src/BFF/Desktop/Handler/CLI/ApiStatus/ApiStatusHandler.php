<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\CLI\ApiStatus;

use SelecaoGlobo\Infrastructure\ServiceBus\CommandHandler\SimpleCommandHandler;

/**
 * Class ApiStatusHandler
 */
final class ApiStatusHandler extends SimpleCommandHandler
{
    /**
     * @param ApiStatusCommand $command
     */
    public function handleApiStatusCommand(ApiStatusCommand $command)
    {
        dump($command->getMessage());
    }
}
