<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\Hydrator;

use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Hydrator\MatchesHydrator;
use SelecaoGlobo\Unit\Mocks\AbstractMock;

/**
 * Class MatchesHydratorMock
 */
class MatchesHydratorMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(MatchesHydrator::class);
    }

    /**
     * @return MatchesHydrator
     */
    public function getObjectWithMockDependencies(): MatchesHydrator
    {
        return new MatchesHydrator($this->loggerFacade);
    }
}
