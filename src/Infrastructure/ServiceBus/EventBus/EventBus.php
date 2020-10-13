<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\EventBus;

use Closure;
use IteratorAggregate;
use SelecaoGlobo\Infrastructure\ServiceBus\EventListener\EventListenerInterface;

/**
 * Class EventBus
 */
class EventBus implements EventBusInterface
{
    /**
     * @var EventListenerInterface[]
     */
    private array $middlewares = [];

    /**
     * EventBus constructor.
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
     * @param EventListenerInterface $middleware
     */
    public function appendMiddleware(EventListenerInterface $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return EventListenerInterface[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    /**
     * @param IteratorAggregate $message
     */
    public function publish(IteratorAggregate $message)
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
