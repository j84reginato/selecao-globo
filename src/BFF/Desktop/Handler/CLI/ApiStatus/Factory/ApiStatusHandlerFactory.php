<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\CLI\ApiStatus\Factory;

use SelecaoGlobo\BFF\Desktop\Handler\CLI\ApiStatus\ApiStatusHandler;

/**
 * Class ApiStatusHandlerFactory
 */
final class ApiStatusHandlerFactory
{
    /**
     * @return ApiStatusHandler
     */
    public function __invoke(): ApiStatusHandler
    {
        return new ApiStatusHandler();
    }
}
