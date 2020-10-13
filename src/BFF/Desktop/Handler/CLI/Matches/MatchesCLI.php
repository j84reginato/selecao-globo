<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\CLI\Matches;

use Exception;
use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Handler\CLI\AbstractCLI;
use SelecaoGlobo\Infrastructure\ServiceBus\CommandBus\CommandBusInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class MatchesCLI
 */
final class MatchesCLI extends AbstractCLI
{
    public const NAME = 'bff:get-matches';

    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * MatchesCLI constructor.
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
            ->setDescription('Call matches')
            ->setHelp('This command make calls to esportes-api according to the parameters')
            ->addOption(
                'payload',
                null,
                InputOption::VALUE_REQUIRED,
                'The initial and final date',
                '{\"initialDate\":\"2019-01-01\",\"finalDate\":\"2019-01-31\"}'
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
        /** @var CommandBusInterface $commandBus */
        $commandBus = $this->container->get(CommandBusInterface::NAME);
        $payload    = $input->getOption('payload');

        try {
            $output->writeln("<info>Payload: {$payload}</info>");
            $command = MatchesCommand::fromArray(json_decode($payload, true, 512, JSON_THROW_ON_ERROR));
            $commandBus->dispatch($command);
            $output->writeln('<comment>The command has been successfully processed!</comment>');
        } catch (Exception $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");
            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}
