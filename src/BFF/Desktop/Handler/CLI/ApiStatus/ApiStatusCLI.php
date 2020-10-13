<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\CLI\ApiStatus;

use Exception;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Handler\CLI\AbstractCLI;
use SelecaoGlobo\Infrastructure\ServiceBus\CommandBus\CommandBusInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ApiStatusCLI
 */
final class ApiStatusCLI extends AbstractCLI
{
    public const NAME = 'bff:status';

    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * ApiStatusCLI constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct(self::$defaultName);
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setName(self::NAME)
            ->setDefinition(new InputDefinition([]))
            ->setDescription('CLI Status')
            ->setHelp('This command allows you to check the cli status...')
            ->addOption(
                'message',
                null,
                InputOption::VALUE_REQUIRED,
                'The status message',
                'Congratulations! It works'
            );
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            /** @var CommandBusInterface $commandBus */
            $commandBus = $this->container->get(CommandBusInterface::NAME);

            $message = $input->getOption('message');
            $command = ApiStatusCommand::fromArray(['message' => $message]);
            $commandBus->dispatch($command);
        } catch (Exception $e) {
            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}
