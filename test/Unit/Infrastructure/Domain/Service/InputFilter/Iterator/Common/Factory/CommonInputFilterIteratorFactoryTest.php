<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Infrastructure\Domain\Service\InputFilter\Iterator\Common\Factory;

use Exception;
use SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Iterator\Common\Factory\CommonInputFilterIteratorFactory;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class CommonInputFilterIteratorFactoryTest
 */
class CommonInputFilterIteratorFactoryTest extends AbstractUnitTestCase
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
            (new CommonInputFilterIteratorFactory())();
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
