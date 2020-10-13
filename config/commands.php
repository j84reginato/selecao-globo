<?php

declare(strict_types=1);

use SelecaoGlobo\BFF\Desktop\Handler\CLI;

return [
    CLI\ApiStatus\ApiStatusCLI::class,
    CLI\Matches\MatchesCLI::class,
    CLI\Swagger\GenerateSwaggerSchemasCLI::class,
];
