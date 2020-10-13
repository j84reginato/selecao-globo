<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\CommandBus;

use Closure;
use SelecaoGlobo\Infrastructure\ServiceBus\Command\CommandInterface;
use SelecaoGlobo\Infrastructure\ServiceBus\CommandHandler\CommandHandlerMiddlewareInterface;

/**
 * Class ServiceBus
 */
class CommandBus implements CommandBusInterface
{
    /**
     * @var CommandHandlerMiddlewareInterface[]
     */
    private array $middlewares = [];

    /**
     * ServiceBus constructor.
     *
     * @param array $middlewares
     */
    public function __construct(array $middlewares = [])
    {
        foreach ($middlewares as $middleware) {
            $this->appendMiddleware($middleware);
        }
    }

    /**
     * @param CommandHandlerMiddlewareInterface $middleware
     */
    public function appendMiddleware(CommandHandlerMiddlewareInterface $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @param CommandHandlerMiddlewareInterface $middleware
     */
    public function removeMiddleware(CommandHandlerMiddlewareInterface $middleware): void
    {
        foreach ($this->middlewares as $key => $object) {
            if (get_class($object) !== get_class($middleware)) {
                continue;
            }

            unset($this->middlewares[$key]);
        }
    }

    /**
     * @return CommandHandlerMiddlewareInterface[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    /**
     * @param CommandInterface $message
     */
    public function dispatch(CommandInterface $message)
    {
        call_user_func($this->callableForNextMiddleware(0), $message);
    }

    /**
     * @param $index
     *
     * @return Closure
     */
    private function callableForNextMiddleware($index): callable
    {
        if (!isset($this->middlewares[$index])) {
            return static function () {
            };
        }

        $middleware = $this->middlewares[$index];
        return function ($message) use ($middleware, $index) {
            $middleware->handle($message, $this->callableForNextMiddleware($index + 1));
        };
    }
}
