<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\ErrorHandler\Client;

use Bugsnag;

/**
 * class BugsnagClientFacade
 */
class BugsnagClientFacade
{
    /**
     * @var Bugsnag\Client
     */
    private Bugsnag\Client $bugsnag;

    /**
     * BugsnagClientFacade constructor.
     *
     * @param string $key
     * @param string $appRoot
     * @param string $environment
     * @param array  $notify
     */
    public function __construct(
        string $key,
        string $appRoot,
        string $environment,
        array $notify
    ) {
        $this->bugsnag = Bugsnag\Client::make($key);
        $this->bugsnag->getConfig()->setProjectRoot($appRoot);
        $this->bugsnag->getConfig()->setReleaseStage($environment);
        $this->bugsnag->getConfig()->setNotifyReleaseStages($notify);
        $this->bugsnag->getConfig()->setErrorReportingLevel(E_ALL && ~E_DEPRECATED && ~E_NOTICE && ~E_WARNING);
    }

    /**
     * @return Bugsnag\Client
     */
    public function getBugsnag(): Bugsnag\Client
    {
        return $this->bugsnag;
    }
}
