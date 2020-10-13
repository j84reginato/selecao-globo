<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\CommandHandler;

/**
 * Handles dispatched commands.
 */
interface CommandHandlerInterface
{
    /**
     * @param mixed $command
     *
     * @return mixed
     */
    public function handle($command): void;
}
