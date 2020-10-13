<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Handler\API\Request;

/**
 * Interface AttributeRequestInterface
 */
interface AttributeRequestInterface
{
    /**
     * @return string
     */
    public function getAttribute(): string;

    /**
     * @param string $attribute
     */
    public function setAttribute(string $attribute): void;
}
