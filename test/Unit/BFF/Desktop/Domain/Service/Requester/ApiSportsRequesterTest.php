<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Domain\Service\Requester;

use SelecaoGlobo\BFF\Desktop\Domain\Service\Requester\ApiSportsRequester;
use SelecaoGlobo\Unit\AbstractUnitTestCase;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\Requester\ApiSportsRequesterMock;

/**
 * Class ApiSportsRequesterTest
 */
class ApiSportsRequesterTest extends AbstractUnitTestCase
{
    /**
     * @var ApiSportsRequester
     */
    protected ApiSportsRequester $apiSportsRequester;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->apiSportsRequester = (new ApiSportsRequesterMock($this->loggerFacade))->getObjectWithMockDependencies();
    }

    /**
     * @dataProvider getData
     *
     * @param string $date
     *
     * @return void
     */
    public function testCall(string $date): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $list = $this->apiSportsRequester->call($date);

        self::assertIsArray($list);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            [
                '2019-01-01',
            ],
        ];
    }
}
