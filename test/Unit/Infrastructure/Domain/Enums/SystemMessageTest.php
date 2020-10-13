<?php

namespace SelecaoGlobo\Unit\Infrastructure\Domain\Enums;

use SelecaoGlobo\Infrastructure\Domain\Enums\SystemMessage;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class SystemMessageTest
 */
class SystemMessageTest extends AbstractUnitTestCase
{
    /**
     * @param $code
     * @param $params
     *
     * @dataProvider getCode
     */
    public function testGetMessage($code, $params): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s, %s", __METHOD__, $code, $params)
        );

        $message = SystemMessage::getMessage($code, $params);

        $this->loggerFacade->getLogger()->info(sprintf('Message: %s', $message));

        static::assertNotNull($message);
    }

    /**
     * @return array
     */
    public function getCode(): array
    {
        return [
            [null, null],
            [SystemMessage::UNKNOWN_ERROR, null],
            [SystemMessage::READ_SUCCESS, 'soccer matches of day'],
        ];
    }
}
