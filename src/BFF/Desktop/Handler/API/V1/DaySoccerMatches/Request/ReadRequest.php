<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request;

use SelecaoGlobo\Infrastructure\Handler\API\Request\AbstractAttributeRequest;

/**
 * Class ReadRequest
 */
class ReadRequest extends AbstractAttributeRequest
{
    /**
     * @var string
     */
    protected string $attributeName = 'date';
}
