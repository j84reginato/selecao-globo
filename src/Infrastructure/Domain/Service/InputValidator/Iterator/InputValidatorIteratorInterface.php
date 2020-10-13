<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Iterator;

use SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Validator\InputValidatorInterface;

/**
 * Interface InputValidatorIteratorInterface
 */
interface InputValidatorIteratorInterface
{
    /**
     * @param array $parameters
     * @param array $allowedParams
     * @param array $requiredParams
     */
    public function validate(
        array $parameters,
        array $allowedParams,
        array $requiredParams = []
    ): void;

    /**
     * @param InputValidatorInterface $validator
     */
    public function addValidator(InputValidatorInterface $validator): void;
}
