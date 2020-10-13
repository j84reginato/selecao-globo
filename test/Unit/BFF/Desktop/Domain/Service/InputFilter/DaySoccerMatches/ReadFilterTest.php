<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches;

use Exception;
use Prophecy\Doubler\DoubleInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches\ReadFilter;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;
use SelecaoGlobo\Unit\AbstractUnitTestCase;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches\ReadFilterMock;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequestMock;

/**
 * Class ReadFilterTest
 */
class ReadFilterTest extends AbstractUnitTestCase
{
    /**
     * @var ReadFilter
     */
    private ReadFilter $inputFilter;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->inputFilter = (new ReadFilterMock($this->loggerFacade))->getObjectWithMockDependencies();
    }

    /**
     * @return void
     */
    public function testApply(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        /** @var DoubleInterface|ReadRequest $request */
        $request = (new ReadRequestMock($this->loggerFacade))->getMock()->reveal();

        $exception = null;
        try {
            $this->inputFilter->apply([], $request);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }
}
