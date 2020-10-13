<?php

declare(strict_types=1);

chdir(realpath(__DIR__));

define('APP_ROOT', dirname(realpath(__DIR__)));

require '../vendor/autoload.php';

$cachePath = realpath(APP_ROOT) . '/' . (include '../config/config.php')['config_cache_path'];

if (!isset($cachePath)) {
    echo "No configuration cache path found" . PHP_EOL;
    exit(0);
}

if (!file_exists($cachePath)) {
    printf(
        "Configured config cache file '%s' not found%s",
        $cachePath,
        PHP_EOL
    );
    exit(0);
}

if (false === unlink($cachePath)) {
    printf(
        "Error removing config cache file '%s'%s",
        $cachePath,
        PHP_EOL
    );
    exit(1);
}

printf(
    "Removed configured config cache file '%s'%s",
    $cachePath,
    PHP_EOL
);
exit(0);
