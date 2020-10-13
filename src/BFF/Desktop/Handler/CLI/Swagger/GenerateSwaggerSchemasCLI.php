<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\CLI\Swagger;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\Infrastructure\Handler\CLI\AbstractCLI;
use SelecaoGlobo\Infrastructure\Swagger\SwaggerMapper;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GenerateSwaggerSchemasCLI
 */
final class GenerateSwaggerSchemasCLI extends AbstractCLI
{
    /**
     * @var string
     */
    protected static $defaultName = "app:generate-swagger-schemas";

    /**
     * @var SwaggerMapper
     */
    private SwaggerMapper $mapper;

    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * GenerateSwaggerSchemasCommand constructor.
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
            ->setName(self::$defaultName)
            ->setDefinition($this->createDefinition())
            ->setDescription('Generate Swagger Schemas')
            ->setHelp('');

        $mappingPaths = $this->container->get('config')['swagger']['schemaMappingPaths'];
        $this->mapper = new SwaggerMapper($mappingPaths);
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = self::SUCCESS;
        if (!$this->mapper->mapper()) {
            print($this->mapper->getException());
            $result = self::FAILURE;
        } elseif (!$this->mapper->toYaml()) {
            print($this->mapper->getException());
            $result = self::FAILURE;
        } else {
            print(sprintf("Generated file in: %s \n", $this->mapper->getOutputPath()));
        }

        return $result;
    }

    /**
     * @return InputDefinition
     */
    private function createDefinition(): InputDefinition
    {
        return new InputDefinition([]);
    }
}
