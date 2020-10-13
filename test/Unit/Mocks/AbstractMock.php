<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks;

use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;

/**
 * Class AbstractMock
 */
abstract class AbstractMock
{
    /**
     * @var Prophet
     */
    protected Prophet $prophet;

    /**
     * @var LoggerFacade
     */
    protected LoggerFacade $loggerFacade;

    /**
     * AbstractMock constructor.
     *
     * @param LoggerFacade $loggerFacade
     */
    public function __construct(LoggerFacade $loggerFacade)
    {
        $this->prophet      = new Prophet();
        $this->loggerFacade = $loggerFacade;
    }

    /**
     * @param string $class
     *
     * @return ObjectProphecy
     */
    protected function prophesize(string $class): ObjectProphecy
    {
        return $this->prophet->prophesize($class);
    }

    /**
     * @return ObjectProphecy
     */
    abstract public function getMock(): ObjectProphecy;

    /**
     * @return mixed
     */
    abstract public function getObjectWithMockDependencies();
}
