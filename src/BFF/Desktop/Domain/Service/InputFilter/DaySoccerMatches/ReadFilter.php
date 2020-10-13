<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches;

use SelecaoGlobo\BFF\Desktop\Domain\Exception\BadMethodCallException;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;
use SelecaoGlobo\Infrastructure\Domain\Enums\SystemMessage;
use SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Filter\InputFilterInterface;
use SelecaoGlobo\Infrastructure\Handler\API\Request\AttributeRequestInterface;
use SelecaoGlobo\Infrastructure\Handler\API\RequestInterface;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;

/**
 * Class ReadFilter
 */
class ReadFilter implements InputFilterInterface
{
    /**
     * @var LoggerFacade
     */
    private LoggerFacade $loggerFacade;

    /**
     * ReadFilter constructor.
     *
     * @param LoggerFacade $loggerFacade
     */
    public function __construct(LoggerFacade $loggerFacade)
    {
        $this->loggerFacade = $loggerFacade;
    }

    /**
     * @param array                        $parameters
     * @param RequestInterface|ReadRequest $request
     */
    public function apply(array $parameters, RequestInterface $request): void
    {
        if (!$request instanceof AttributeRequestInterface) {
            $errorMessage = SystemMessage::getMessage(SystemMessage::INVALID_REQUEST_TYPE_ERROR);
            $this->loggerFacade->getLogger()->error($errorMessage);
            throw new BadMethodCallException($errorMessage);
        }
    }
}
