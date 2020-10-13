<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Handler\API\Request;

use JsonException;
use Psr\Http\Message\ServerRequestInterface;
use SelecaoGlobo\Infrastructure\Handler\API\AbstractRequest;

/**
 * Class AbstractBodyRequest
 */
abstract class AbstractBodyRequest extends AbstractRequest implements BodyRequestInterface
{
    /**
     * @var array
     */
    protected array $payload;

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
     * @throws JsonException
     */
    public function parse(ServerRequestInterface $serverRequest): self
    {
        $this->payload = json_decode($serverRequest->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        $this->validatorIterator->validate(
            $this->payload,
            $this->allowedParams,
            $this->requiredParams
        );

        $this->filterIterator->filter($this->payload, $this);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->payload;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * @param array $payload
     */
    public function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }
}
