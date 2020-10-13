<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Domain\View;

use DomainException;
use SelecaoGlobo\Infrastructure\Domain\Enums\SystemMessage;

/**
 * Class AbstractView
 */
abstract class AbstractView
{
    /**
     * @param array $entities
     *
     * @return array
     */
    public static function serializeFromArray(array $entities): array
    {
        if (!is_array($entities)) {
            $type         = get_class((string)$entities);
            $errorMessage = SystemMessage::getMessage(SystemMessage::INVALID_PARAMETER_TYPE_ERROR, [$type, 'array']);
            throw new DomainException($errorMessage);
        }

        return array_map(static function ($entity) {
            return (new static($entity))->serialize();
        }, $entities);
    }

    /**
     * @return array
     */
    abstract public function serialize(): array;
}
