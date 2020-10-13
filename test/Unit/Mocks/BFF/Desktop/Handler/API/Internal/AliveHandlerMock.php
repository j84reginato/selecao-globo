<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Handler\API\Internal;

use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Handler\API\Internal\AliveHandler;
use SelecaoGlobo\Unit\Mocks\AbstractMock;

/**
 * Class AliveHandler
 */
class AliveHandlerMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(AliveHandler::class);
    }

    /**
     * @return AliveHandler
     */
    public function getObjectWithMockDependencies(): AliveHandler
    {
        return new AliveHandler();
    }
}
