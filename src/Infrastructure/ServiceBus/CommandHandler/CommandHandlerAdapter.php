<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\CommandHandler;

use SelecaoGlobo\Infrastructure\ServiceBus\Command\CommandInterface;
use SelecaoGlobo\Infrastructure\ServiceBus\CommandBus\CommandBusAdapter;

/**
 * Class BroadwayCommandBusMiddleware
 */
class CommandHandlerAdapter implements CommandHandlerMiddlewareInterface
{
    /**
     * @var CommandBusAdapter
     */
    private CommandBusAdapter $bus;

    /**
     * BroadwayCommandBusMiddleware constructor.
     *
     * @param CommandBusAdapter $bus
     */
    public function __construct(CommandBusAdapter $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @param CommandInterface $command
     * @param callable         $next
     */
    public function handle(CommandInterface $command, callable $next)
    {
        $this->bus->dispatch($command);
        $next($command);
    }
}
