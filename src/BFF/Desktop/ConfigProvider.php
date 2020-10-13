<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop;

use SelecaoGlobo\BFF\Desktop\Application\Config;
use SelecaoGlobo\BFF\Desktop\Application\Dependency\Domain;
use SelecaoGlobo\BFF\Desktop\Application\Dependency\Handler;
use SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure;

/**
 * Class ConfigProvider
 *
 * The configuration provider for the App module
 */
class ConfigProvider
{
    /**
     * Returns the configuration array.
     *
     * Destination add a bit of a structure.
     * Each section is defined in a separate method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'api'          => Config\Api::getConfig(),
            'cache'        => Config\Cache::getConfig(),
            'cors'         => Config\Cors::getConfig(),
            'errorHandler' => Config\ErrorHandler::getConfig(),
            'healthCheck'  => Config\HealthCheck::getConfig(),
            'jwt'          => Config\JwtAuthentication::getConfig(),
            'logger'       => Config\Logger::getConfig(),
            'serviceBus'   => Config\ServiceBus::getConfig(),
            'swagger'      => Config\SwaggerSchema::getConfig(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies.
     *
     * @return array
     */
    public function getDependencies(): array
    {
        return array_merge_recursive(
            Domain\Service\Finder::getDependencies(),
            Domain\Service\Hydrator::getDependencies(),
            Domain\Service\InputFilter::getDependencies(),
            Domain\Service\InputValidator::getDependencies(),
            Domain\Service\Requester::getDependencies(),
            Handler\API\Action\APIHandler::getDependencies(),
            Handler\API\Request\APIRequest::getDependencies(),
            Handler\API\Response\APIResponse::getDependencies(),
            Handler\HTML\HTMLHandler::getDependencies(),
            Infrastructure\Api::getDependencies(),
            Infrastructure\Cache::getDependencies(),
            Infrastructure\CommonInputFilterService::getDependencies(),
            Infrastructure\CommonInputValidatorService::getDependencies(),
            Infrastructure\Cors::getDependencies(),
            Infrastructure\ErrorHandler::getDependencies(),
            Infrastructure\HealthCheck::getDependencies(),
            Infrastructure\JwtAuthentication::getDependencies(),
            Infrastructure\Logger::getDependencies(),
            Infrastructure\RequestId::getDependencies(),
            Infrastructure\ServiceBus::getDependencies(),
            Infrastructure\ServiceBus\CommandHandler::getDependencies(),
            Infrastructure\ServiceBus\EventListener::getDependencies(),
            Infrastructure\Swagger::getDependencies()
        );
    }

    /**
     * Returns the templates configuration.
     *
     * @return array
     */
    public function getTemplates(): array
    {
        return [
            'extension' => 'phtml',
            'paths'     => [
                'app'    => [APP_ROOT . '/templates/app'],
                'error'  => [APP_ROOT . '/templates/error'],
                'layout' => [APP_ROOT . '/templates/layout'],
            ],
        ];
    }
}
