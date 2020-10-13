<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Domain\Service\InputValidator\DaySoccerMatches;

use Exception;
use SelecaoGlobo\BFF\Desktop\Domain\Service\InputValidator\DaySoccerMatches\ReadValidator;
use SelecaoGlobo\Unit\AbstractUnitTestCase;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\InputValidator\DaySoccerMatches\ReadValidatorMock;

/**
 * Class ReadValidatorTest
 */
class ReadValidatorTest extends AbstractUnitTestCase
{
    /**
     * @var ReadValidator
     */
    private ReadValidator $inputValidator;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->inputValidator = (new ReadValidatorMock($this->loggerFacade))->getObjectWithMockDependencies();
    }

    /**
     * @dataProvider getData
     *
     * @param array $date
     *
     * @return void
     */
    public function testApply(array $date): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $exception = null;
        try {
            $this->inputValidator->apply($date);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            [
                ['date' => '2019-01-01'],
            ],
        ];
    }
}
