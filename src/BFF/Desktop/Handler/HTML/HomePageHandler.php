<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\HTML;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Plates\PlatesRenderer;
use Mezzio\Router\FastRouteRouter;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class HomePageHandler
 */
class HomePageHandler implements RequestHandlerInterface
{
    /**
     * @var string
     */
    private string $containerName;

    /**
     * @var RouterInterface
     */
    private RouterInterface $router;

    /**
     * @var null|TemplateRendererInterface
     */
    private ?TemplateRendererInterface $template;

    /**
     * HomePageHandler constructor.
     *
     * @param string                         $containerName
     * @param RouterInterface                $router
     * @param TemplateRendererInterface|null $template
     */
    public function __construct(
        string $containerName,
        RouterInterface $router,
        ?TemplateRendererInterface $template = null
    ) {
        $this->containerName = $containerName;
        $this->router        = $router;
        $this->template      = $template;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($this->template === null) {
            return new JsonResponse([
                'ack'     => time(),
                'welcome' => 'Congratulations! It works',
                'docsUrl' => 'http://localhost:8181',
            ]);
        }

        if ($this->containerName === 'Laminas\ServiceManager\ServiceManager') {
            $data['containerName'] = 'Laminas Servicemanager';
            $data['containerDocs'] = 'https://docs.laminas.dev/laminas-servicemanager/';
        }

        if ($this->router instanceof FastRouteRouter) {
            $data['routerName'] = 'FastRoute';
            $data['routerDocs'] = 'https://github.com/nikic/FastRoute';
        }

        if ($this->template instanceof PlatesRenderer) {
            $data['templateName'] = 'Plates';
            $data['templateDocs'] = 'http://platesphp.com/';
        }

        return new HtmlResponse($this->template->render('app::home'));
    }
}
