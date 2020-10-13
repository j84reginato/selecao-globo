<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\CommandHandler;

use Broadway\CommandHandling\CommandHandler;
use SelecaoGlobo\Infrastructure\Domain\Exception\CommandHandlerException;

/**
 * Class SimpleCommandHandler
 */
abstract class SimpleCommandHandler implements CommandHandlerInterface, CommandHandler
{
    /**
     * @param mixed $command
     *
     * @return mixed|void
     */
    public function handle($command): void
    {
        $method = $this->getHandleMethod($command);

        if (!method_exists($this, $method)) {
            return;
        }

        $this->$method($command);
    }

    /**
     * @param $command
     *
     * @return string
     */
    private function getHandleMethod($command): string
    {
        if (!is_object($command)) {
            throw new CommandHandlerException('Command not an object');
        }

        $classParts = explode('\\', get_class($command));

        return 'handle' . end($classParts);
    }
}
