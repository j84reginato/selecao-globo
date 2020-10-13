<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ErrorHandler\Listener;

use Bugsnag;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

/**
 * Class BugsnagListener
 */
class BugsnagListener
{
    /**
     * @var Bugsnag\Client
     */
    private Bugsnag\Client $bugsnag;

    /**
     * BugsnagListener constructor.
     *
     * @param Bugsnag\Client $bugsnag
     */
    public function __construct(Bugsnag\Client $bugsnag)
    {
        $this->bugsnag = $bugsnag;
    }

    /**
     * @param Throwable              $error
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     */
    public function __invoke(Throwable $error, ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->bugsnag->notifyException($error, static function (Bugsnag\Report $report) use ($response, $request) {
            $report->setSeverity('error');
            $report->setUser([
                'token' => $request->getHeader('Authorization'),
            ]);
            $report->setMetaData([
                'status' => [
                    'code' => $response->getStatusCode(),
                ],
                'body'   => [
                    'contents' => $request->getBody()->getContents(),
                ],
            ]);
        });
    }
}
