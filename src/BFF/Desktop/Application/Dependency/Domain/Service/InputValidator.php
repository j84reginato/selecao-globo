<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Application\Dependency\Domain\Service;

use SelecaoGlobo\BFF\Desktop\Domain\Service\InputValidator\DaySoccerMatches\Factory\ReadValidatorFactory;
use SelecaoGlobo\BFF\Desktop\Domain\Service\InputValidator\DaySoccerMatches\ReadValidator;

/**
 * Class InputValidator
 */
final class InputValidator
{
    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [
            'factories' => [
                ReadValidator::class => ReadValidatorFactory::class,
            ],
        ];
    }
}
