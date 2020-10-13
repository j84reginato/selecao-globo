<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Validator;

/**
 * Interface InputValidatorIteratorInterface
 */
interface InputValidatorInterface
{
    /**
     * @param array $parameters
     */
    public function apply(array $parameters): void;
}
