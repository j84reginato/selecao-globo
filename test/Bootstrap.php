<?php

use Dotenv\Dotenv;
use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;
use Ramsey\Uuid\Uuid;

date_default_timezone_set('Etc/GMT+3');

define('START_EXECUTION_TIME', microtime(true));
define('APP_ROOT', dirname(__DIR__));
define('APP_ENV', getenv('APPLICATION_ENV'));

// Setup autoloading
include_once(APP_ROOT . '/vendor/autoload.php');

// Generate and define a RFC 4122 version 4 universally unique identifiers (UUID).
try {
    define('REQUEST_ID', Uuid::uuid4());
} catch (Exception $e) {
    echo $e->getCode() . ':' . $e->getMessage();
}

// Copy the .env file
copy(__DIR__ . '/../environment/test.env', __DIR__ . '/.env');

// Loads environment variables from .env to getenv(), $_ENV and $_SERVER automagically.
$dotenv = Dotenv::createMutable(__DIR__);
$dotenv->load();

// Self-called anonymous function that creates its own scope and keep the global namespace clean.
(static function () {
    /** @var ContainerInterface $container */
    $container = require __DIR__ . '/../config/container.php';
    $app       = $container->get(Application::class);
    $factory   = $container->get(MiddlewareFactory::class);

    // Execute programmatic/declarative middleware pipeline and routing configuration statements
    (require __DIR__ . '/../config/pipeline.php')($app, $factory, $container);
    (require __DIR__ . '/../config/routes.php')($app, $factory, $container);
})();
