<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Handler\CLI;

use Symfony\Component\Console\Command\Command;

/**
 * Class AbstractCLI
 */
abstract class AbstractCLI extends Command
{
    public const SUCCESS = 0;
    public const FAILURE = 1;
}
