<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Response;

use JsonException;
use Prophecy\Doubler\DoubleInterface;
use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Finder\MatchesFinder;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Response\ReadResponse;
use SelecaoGlobo\Unit\Mocks\AbstractMock;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\Finder\MatchesFinderMock;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\Hydrator\MatchesHydratorMock;

/**
 * Class ReadResponseMock
 */
class ReadResponseMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     * @throws JsonException
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(ReadResponse::class);
    }

    /**
     * @return ReadResponse
     * @throws JsonException
     */
    public function getObjectWithMockDependencies(): ReadResponse
    {
        /** @var DoubleInterface|MatchesFinder $matchesFinder */
        $matchesFinder   = (new MatchesFinderMock($this->loggerFacade))->getMock()->reveal();
        $matchesHydrator = (new MatchesHydratorMock($this->loggerFacade))->getObjectWithMockDependencies();

        return new ReadResponse($matchesFinder, $matchesHydrator);
    }
}
