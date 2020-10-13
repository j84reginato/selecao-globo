<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ServiceBus\Middleware;

use Psr\Log\LoggerInterface;
use SelecaoGlobo\Infrastructure\ServiceBus\Command\CommandInterface;
use SelecaoGlobo\Infrastructure\ServiceBus\CommandHandler\CommandHandlerMiddlewareInterface;
use Throwable;

/**
 * Class LogCommandsMiddleware
 */
class LogCommandsMiddleware implements CommandHandlerMiddlewareInterface
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * LogCommandsMiddleware constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param CommandInterface $command
     * @param callable         $next
     *
     * @throws Throwable
     */
    public function handle(CommandInterface $command, callable $next)
    {
        $message = [
            'command_class'  => get_class($command),
            'command_name'   => $this->getCommandName($command),
            'command_params' => $command->toArray(),
        ];

        try {
            $this->logger->info("Start handling a Command", $message);
            $next($command);
            $this->logger->info("Finish handling a Command\n", $message);
            $this->logger->info(
                "This process used " . $this->runTime(getrusage(), RESOURCE_USAGE, "utime") .
                " ms for its computations."
            );
            $this->logger->info(
                "It spent " . $this->runTime(getrusage(), RESOURCE_USAGE, "stime") .
                " ms in system calls."
            );
            $this->logger->info("Total execution time in seconds: " . (microtime(true) - START_EXECUTION_TIME));
        } catch (Throwable $e) {
            $context = $message + [
                    'error'           => $e->getMessage(),
                    'exception_class' => get_class($e),
                    'trace'           => $e->getTraceAsString(),
                ];

            $this->logger->error('An error occurred while trying to handling a command', $context);

            throw $e;
        }
    }

    /**
     * @param CommandInterface $command
     *
     * @return string
     */
    private function getCommandName(CommandInterface $command): string
    {
        $className   = explode('\\', get_class($command));
        $className   = end($className);
        $splitedName = preg_split('/(?=[A-Z])/', $className, -1, PREG_SPLIT_NO_EMPTY);

        return implode(' ', $splitedName);
    }

    /**
     * @param array  $rue
     * @param array  $rus
     * @param string $index
     *
     * @return float
     */
    private function runTime(array $rue, array $rus, string $index): float
    {
        return (($rue["ru_$index.tv_sec"] * 1000) + (int)($rue["ru_$index.tv_usec"] / 1000))
            - (($rus["ru_$index.tv_sec"] * 1000) + (int)($rus["ru_$index.tv_usec"] / 1000));
    }
}
