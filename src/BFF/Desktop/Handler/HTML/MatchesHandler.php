<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\HTML;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class MatchesHandler
 */
class MatchesHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private TemplateRendererInterface $template;

    /**
     * MatchesHandler constructor.
     *
     * @param TemplateRendererInterface $template
     */
    public function __construct(TemplateRendererInterface $template)
    {
        $this->template = $template;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->template->render('app::matches'));
    }
}
