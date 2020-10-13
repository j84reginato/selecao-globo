<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Handler\HTML;

use SelecaoGlobo\BFF\Desktop\Handler\HTML;

/**
 * Class HTMLHandler
 */
final class HTMLHandler
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                HTML\HomePageHandler::class        => HTML\Factory\HomePageHandlerFactory::class,
                HTML\ResourcesHandler::class       => HTML\Factory\HtmlHandlerFactory::class,
                HTML\SetupHandler::class           => HTML\Factory\HtmlHandlerFactory::class,
                HTML\CommitStandardsHandler::class => HTML\Factory\HtmlHandlerFactory::class,
                HTML\CodingStandardsHandler::class => HTML\Factory\HtmlHandlerFactory::class,
                HTML\ConductCodeHandler::class     => HTML\Factory\HtmlHandlerFactory::class,
                HTML\TodoListHandler::class        => HTML\Factory\HtmlHandlerFactory::class,
                HTML\ApiDocHandler::class          => HTML\Factory\HtmlHandlerFactory::class,
                HTML\CoverageHandler::class        => HTML\Factory\HtmlHandlerFactory::class,
                HTML\MatchesHandler::class         => HTML\Factory\HtmlHandlerFactory::class,
            ],
        ];
    }
}
