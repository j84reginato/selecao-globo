<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\HTML\Factory;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class HtmlHandlerFactory
 */
class HtmlHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @param string             $request
     *
     * @return RequestHandlerInterface
     */
    public function __invoke(ContainerInterface $container, string $request): RequestHandlerInterface
    {
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        return new $request($template);
    }
}
