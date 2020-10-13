<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Handler\API;

use Psr\Http\Message\ServerRequestInterface;
use SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Iterator\InputFilterIteratorInterface;
use SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Iterator\InputValidatorIteratorInterface;

/**
 * Class AbstractRequest
 */
abstract class AbstractRequest implements RequestInterface
{
    /**
     * @var InputFilterIteratorInterface
     */
    protected InputFilterIteratorInterface $filterIterator;

    /**
     * @var InputValidatorIteratorInterface
     */
    protected InputValidatorIteratorInterface $validatorIterator;

    /**
     * @var array
     */
    protected array $allowedParams;

    /**
     * @var array
     */
    protected array $requiredParams;

    /**
     * AbstractRequest constructor.
     *
     * @param InputFilterIteratorInterface    $filterIterator
     * @param InputValidatorIteratorInterface $validatorIterator
     */
    public function __construct(
        InputFilterIteratorInterface $filterIterator,
        InputValidatorIteratorInterface $validatorIterator
    ) {
        $this->filterIterator    = $filterIterator;
        $this->validatorIterator = $validatorIterator;
    }

    /**
     * @param ServerRequestInterface $serverRequest
     *
     * @return $this
     */
    abstract public function parse(ServerRequestInterface $serverRequest): self;

    /**
     * @param string $property
     * @param string $default
     *
     * @return mixed
     */
    public function getProperty(string $property = '', string $default = '')
    {
        if (!$property) {
            return $this;
        }

        return property_exists($this, $property) ? $this->{$property} : $default;
    }

    /**
     * @param string $property
     * @param mixed  $value
     * @param bool   $isArray
     * @param mixed  $key
     */
    public function setProperty(string $property, $value, bool $isArray = false, $key = null): void
    {
        if (!$isArray) {
            $this->{$property} = $value;
            return;
        }

        if ($key) {
            $this->{$property}[$key][] = $value;
            return;
        }

        $this->{$property}[] = $value;
    }

    /**
     * @param string $property
     */
    public function unsetProperty(string $property): void
    {
        unset($this->{$property});
    }

    /**
     * @return void
     */
    public function clearObjectVars(): void
    {
        $objectVars = get_object_vars($this);
        foreach ($objectVars as $var) {
            unset($this->{$var});
        }
    }

    /**
     * @return array
     */
    abstract public function toArray(): array;
}
