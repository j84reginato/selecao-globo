<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\CommandHandler;

use SelecaoGlobo\Infrastructure\ServiceBus\Command\CommandInterface;

/**
 * Interface CommandHandlerMiddlewareInterface
 */
interface CommandHandlerMiddlewareInterface
{
    /**
     * @param CommandInterface $command
     * @param callable         $next
     *
     * @return mixed
     */
    public function handle(CommandInterface $command, callable $next);
}
