<?php

declare(strict_types=1);

/**
 * Configuration files are loaded in a specific order.
 * First ``global.php`` and afterwards ``local.php``.
 * This way local settings overwrite global settings.
 *
 * The configuration can be cached. This can be done by setting ``config_cache_enabled`` to ``true``.
 *
 * The configuration is stored in json so it is not depended on 3rd party libraries.
 * Feel free to use something else like Laminas\ApplicationConfig\Writer to write PHP arrays.
 *
 * Obviously, if you use closures in your config you can't cache it.
 */

// Destination caching.
// Set the `ConfigAggregator::ENABLE_CACHE` boolean in `config/autoload/local.php`.
$cacheConfig = [
    'config_cache_path' => 'cache/app_config_cache.php',
];

$aggregator = new Laminas\ConfigAggregator\ConfigAggregator([
    // Include required system config providers.
    Laminas\HttpHandlerRunner\ConfigProvider::class,

    // Include cache configuration.
    new Laminas\ConfigAggregator\ArrayProvider($cacheConfig),

    // Mezzio config providers.
    Mezzio\ConfigProvider::class,
    Mezzio\Helper\ConfigProvider::class,
    Mezzio\Plates\ConfigProvider::class,
    Mezzio\Router\ConfigProvider::class,
    Mezzio\Router\FastRouteRouter\ConfigProvider::class,

    // Swoole config to overwrite some services (if installed)
    // class_exists(Mezzio\Swoole\ConfigProvider::class)
    //     ? Mezzio\Swoole\ConfigProvider::class
    //     : function(){ return[]; },

    // Default App module config.
    SelecaoGlobo\BFF\Desktop\ConfigProvider::class,

    // Load application config in a pre-defined order in such a way that local settings overwrite global settings.
    // (Loaded as first to last):
    //   - `global.php`
    //   - `*.global.php`
    //   - `local.php`
    //   - `*.local.php`
    new Laminas\ConfigAggregator\PhpFileProvider(realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php'),

    // Load development config if it exists.
    new Laminas\ConfigAggregator\PhpFileProvider(realpath(__DIR__) . '/development.config.php'),
], $cacheConfig['config_cache_path']);

return $aggregator->getMergedConfig();
