<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Handler\API;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface RequestInterface
 */
interface RequestInterface
{
    /**
     * @param ServerRequestInterface $serverRequest
     *
     * @return $this
     */
    public function parse(ServerRequestInterface $serverRequest): self;

    /**
     * @param string $property
     *
     * @return mixed
     */
    public function getProperty(string $property = '');

    /**
     * @param string $property
     * @param mixed  $value
     * @param bool   $isArray
     * @param null   $key
     */
    public function setProperty(string $property, $value, bool $isArray = false, $key = null): void;

    /**
     * @param string $property
     */
    public function unsetProperty(string $property): void;

    /**
     * @return void
     */
    public function clearObjectVars(): void;
}
