<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Domain\Service\Finder;

use JsonException;
use Prophecy\Doubler\DoubleInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Finder\MatchesFinder;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;
use SelecaoGlobo\Unit\AbstractUnitTestCase;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\Finder\MatchesFinderMock;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequestMock;

/**
 * Class MatchesFinderTest
 */
class MatchesFinderTest extends AbstractUnitTestCase
{
    /**
     * @var MatchesFinder
     */
    protected MatchesFinder $matchesFinder;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->matchesFinder = (new MatchesFinderMock($this->loggerFacade))->getObjectWithMockDependencies();
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function testList(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        /** @var DoubleInterface|ReadRequest $request */
        $request = (new ReadRequestMock($this->loggerFacade))->getMock()->reveal();

        $list = $this->matchesFinder->getList($request);

        self::assertIsArray($list);
    }
}
