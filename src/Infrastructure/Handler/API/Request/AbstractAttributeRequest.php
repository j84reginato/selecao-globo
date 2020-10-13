<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Handler\API\Request;

use Psr\Http\Message\ServerRequestInterface;
use SelecaoGlobo\Infrastructure\Handler\API\AbstractRequest;

/**
 * Class AbstractAttributeRequest
 */
abstract class AbstractAttributeRequest extends AbstractRequest implements AttributeRequestInterface
{
    /**
     * @var string
     */
    protected string $attribute;

    /**
     * @var string
     */
    protected string $attributeName = 'id';

    /**
     * @var array
     */
    protected array $allowedParams = [];

    /**
     * @var array
     */
    protected array $requiredParams = [];

    /**
     * @param ServerRequestInterface $serverRequest
     *
     * @return $this
     */
    public function parse(ServerRequestInterface $serverRequest): self
    {
        $this->attribute = (string)$serverRequest->getAttribute($this->attributeName);

        $this->validatorIterator->validate(
            [$this->attributeName => $this->attribute],
            $this->allowedParams,
            $this->requiredParams
        );

        $this->filterIterator->filter([$this->attributeName => $this->attribute], $this);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'attribute' => $this->attribute,
        ];
    }

    /**
     * @return string
     */
    public function getAttribute(): string
    {
        return $this->attribute;
    }

    /**
     * @param string $attribute
     */
    public function setAttribute(string $attribute): void
    {
        $this->attribute = $attribute;
    }
}
