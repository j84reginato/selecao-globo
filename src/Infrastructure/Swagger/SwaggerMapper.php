<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Swagger;

use Exception;
use Symfony\Component\Yaml\Yaml;

/**
 * Class SwaggerMapper
 */
final class SwaggerMapper
{
    /**
     * @var string[]
     */
    private array $mappingPaths;

    /**
     * @var array
     */
    private array $schemas = [];

    /**
     * @var Exception
     */
    private Exception $exception;

    /**3
     * @var string
     */
    private string $outputPath = APP_ROOT . '/public/swagger/schemas.yaml';

    /**
     * SwaggerMapper constructor.
     *
     * @param $mappingPaths
     */
    public function __construct($mappingPaths)
    {
        $this->mappingPaths = $mappingPaths;
    }

    /**
     * @return bool
     */
    public function mapper(): bool
    {
        $result = true;

        $glob = [];
        foreach ($this->mappingPaths as $path) {
            $path   = realpath($path);
            $glob[] = glob(realpath($path) . "/*.yaml");
        }

        $schemaFiles = array_merge([], ...$glob);

        foreach ($schemaFiles as $file) {
            try {
                $content         = file_get_contents($file);
                $this->schemas[] = $content;
            } catch (Exception $e) {
                $this->exception = $e;
                $result          = false;
            }
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function toYaml(): bool
    {
        $result = true;
        $data   = [
            'components' => [
                'schemas' => [],
            ],
        ];

        foreach ($this->schemas as $yaml) {
            $schemaData = Yaml::parse($yaml);
            if ($schemaData && $schemaData['components']['schemas']) {
                $data['components']['schemas'] = array_merge(
                    $data['components']['schemas'],
                    $schemaData['components']['schemas']
                );
            }
        }

        try {
            $content = Yaml::dump($data);
            file_put_contents($this->outputPath, $content);
        } catch (Exception $e) {
            $this->exception = $e;
            $result          = false;
        }

        return $result;
    }

    /**
     * @return Exception
     */
    public function getException(): Exception
    {
        return $this->exception;
    }

    /**
     * @return array
     */
    public function getSchemas(): array
    {
        return $this->schemas;
    }

    /**
     * @return string
     */
    public function getOutputPath(): string
    {
        return $this->outputPath;
    }
}
