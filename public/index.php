<?php

declare(strict_types=1);

use Bugsnag\Client;
use Bugsnag\Handler;
use Dotenv\Dotenv;
use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;
use Ramsey\Uuid\Uuid;

date_default_timezone_set('Etc/GMT+3');

define('RESOURCE_USAGE', getrusage());
define('START_EXECUTION_TIME', microtime(true));
define('APP_ROOT', dirname(__DIR__));
define('APP_ENV', getenv('APPLICATION_ENV'));

// Delegate static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

// This makes our life easier when dealing with paths. Everything is relative to the application root now.
chdir(dirname(__DIR__));

// Setup autoloading
require 'vendor/autoload.php';

// Generate and define a RFC 4122 version 4 universally unique identifiers (UUID).
try {
    define('REQUEST_ID', Uuid::uuid4());
} catch (Exception $e) {
    echo $e->getCode() . ':' . $e->getMessage();
}

// Loads environment variables from .env to getenv(), $_ENV and $_SERVER automagically.
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$bugsnag = Client::make(getenv('BUGSNAG_KEY'));
$bugsnag->getConfig()->setProjectRoot(APP_ROOT);
$bugsnag->getConfig()->setReleaseStage(APP_ENV);
$bugsnag->getConfig()->setErrorReportingLevel(E_ALL && ~E_DEPRECATED && ~E_NOTICE && ~E_WARNING);
Handler::register($bugsnag);

// Self-called anonymous function that creates its own scope and keep the global namespace clean.
(static function () {
    /** @var ContainerInterface $container */
    $container = require __DIR__ . '/../config/container.php';
    $app       = $container->get(Application::class);
    $factory   = $container->get(MiddlewareFactory::class);

    // Execute programmatic/declarative middleware pipeline and routing configuration statements
    (require __DIR__ . '/../config/pipeline.php')($app, $factory, $container);
    (require __DIR__ . '/../config/routes.php')($app, $factory, $container);

    $app->run();
})();
