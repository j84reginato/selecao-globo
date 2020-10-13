<?php

namespace SelecaoGlobo\Unit\Infrastructure\Domain\Service\InputFilter\Iterator\Common;

use Exception;
use JsonException;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;
use SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Iterator\Common\CommonInputFilterIterator;
use SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Iterator\InputFilterIteratorInterface;
use SelecaoGlobo\Unit\AbstractUnitTestCase;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches\ReadFilterMock;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequestMock;

/**
 * Class CommonInputFilterIteratorTest
 */
class CommonInputFilterIteratorTest extends AbstractUnitTestCase
{
    /**
     * @var InputFilterIteratorInterface $iterator
     */
    private InputFilterIteratorInterface $iterator;

    /**
     * @var ReadRequest $request
     */
    private $request;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $filters        = [(new ReadFilterMock($this->loggerFacade))->getObjectWithMockDependencies()];
        $this->iterator = new CommonInputFilterIterator([]);

        foreach ($filters as $filter) {
            $this->iterator->addFilter($filter);
        }
    }

    /**
     * @param $data
     *
     * @dataProvider getSingleData
     * @throws JsonException
     */
    public function testFilter($data): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, json_encode($data, JSON_THROW_ON_ERROR))
        );

        $this->request = (new ReadRequestMock($this->loggerFacade))->getObjectWithMockDependencies();

        $exception = null;
        try {
            $this->iterator->filter($data, $this->request);
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNull($exception);
    }

    /**
     * @return array[]
     */
    public function getSingleData(): array
    {
        return [
            [
                ['2019-01-01']
            ],
        ];
    }
}
