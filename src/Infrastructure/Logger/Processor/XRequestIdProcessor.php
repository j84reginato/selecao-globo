<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Logger\Processor;

/**
 * Class XRequestIdProcessor
 */
final class XRequestIdProcessor
{
    /**
     * @param array $record
     *
     * @return array
     */
    public function __invoke(array $record): array
    {
        $record['extra']['request_id'] = REQUEST_ID;

        return $record;
    }
}
