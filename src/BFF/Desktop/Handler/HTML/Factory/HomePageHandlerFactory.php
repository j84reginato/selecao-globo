<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\HTML\Factory;

use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SelecaoGlobo\BFF\Desktop\Handler\HTML\HomePageHandler;
use function get_class;

/**
 * Class HomePageHandlerFactory
 */
class HomePageHandlerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return RequestHandlerInterface
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $router   = $container->get(RouterInterface::class);
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        return new HomePageHandler(get_class($container), $router, $template);
    }
}
