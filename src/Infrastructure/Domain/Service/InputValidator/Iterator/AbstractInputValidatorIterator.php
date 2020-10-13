<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Iterator;

use Assert\Assertion;
use Assert\AssertionFailedException;
use SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Validator\InputValidatorInterface;

/**
 * Class AbstractInputValidatorIterator
 */
abstract class AbstractInputValidatorIterator implements InputValidatorIteratorInterface
{
    /**
     * @var array|InputValidatorIteratorInterface[]
     */
    protected array $validators;

    /**
     * ValidatorManager constructor.
     *
     * @param InputValidatorIteratorInterface[] $validators
     */
    public function __construct(array $validators)
    {
        $this->validators = $validators;
    }

    /**
     * @param array $parameters
     * @param array $allowedParams
     * @param array $requiredParams
     *
     * @throws AssertionFailedException
     */
    public function validate(
        array $parameters,
        array $allowedParams,
        array $requiredParams = []
    ): void {
        $this->validateParams($parameters, $allowedParams, $requiredParams);

        /** @var InputValidatorInterface $validator */
        foreach ($this->validators as $validator) {
            $validator->apply($parameters);
        }
    }

    /**
     * @param array $parameters
     * @param array $allowedParams
     * @param array $requiredParams
     *
     * @throws AssertionFailedException
     */
    protected function validateParams(array $parameters, array $allowedParams, array $requiredParams = []): void
    {
        if (count($allowedParams)) {
            $this->checkAllowedParams($parameters, $allowedParams);
        }

        if (count($requiredParams)) {
            $this->checkRequireParams($parameters, $requiredParams);
        }
    }

    /**
     * @param array $parameters
     * @param array $allowedParams
     */
    private function checkAllowedParams(array $parameters, array $allowedParams): void
    {
        $keysReceived = array_keys($parameters);
        Assertion::allInArray($keysReceived, $allowedParams);
    }

    /**
     * @param array $parameters
     * @param array $requiredParams
     *
     * @throws AssertionFailedException
     */
    private function checkRequireParams(array $parameters, array $requiredParams): void
    {
        foreach ($requiredParams as $key => $required) {
            if (is_array($required)) {
                Assertion::keyIsset($parameters, $key);
                foreach ($required as $value) {
                    if (is_array($parameters[$key]) && array_key_exists(0, $parameters[$key])) {
                        foreach ($parameters[$key] as $subarray) {
                            Assertion::keyIsset($subarray, $value);
                        }
                    } else {
                        Assertion::keyIsset($parameters[$key], $value);
                    }
                }
                continue;
            }
            Assertion::keyIsset($parameters, $required);
        }
    }

    /**
     * @param InputValidatorInterface $validator
     */
    public function addValidator(InputValidatorInterface $validator): void
    {
        if (empty($this->validators)) {
            $this->validators = [];
        }
        $this->validators[] = $validator;
    }
}
