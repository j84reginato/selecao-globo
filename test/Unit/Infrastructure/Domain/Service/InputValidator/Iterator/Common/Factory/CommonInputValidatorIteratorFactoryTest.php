<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\Domain\Service\InputFilter\Iterator\Common\Factory;

use Exception;
use SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Iterator\Common\Factory;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class CommonInputValidatorIteratorFactoryTest
 */
class CommonInputValidatorIteratorFactoryTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testInvoke(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $exception = null;
        try {
            (new Factory\CommonInputValidatorIteratorFactory())();
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
