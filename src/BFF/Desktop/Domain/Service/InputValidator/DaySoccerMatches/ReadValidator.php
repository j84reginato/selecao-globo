<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\Service\InputValidator\DaySoccerMatches;

use InvalidArgumentException;
use Respect\Validation\Validator;
use SelecaoGlobo\Infrastructure\Domain\Enums\SystemMessage;
use SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Validator\InputValidatorInterface;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;

/**
 * Class ReadValidator
 */
final class ReadValidator implements InputValidatorInterface
{
    /**
     * @var LoggerFacade
     */
    protected LoggerFacade $loggerFacade;

    /**
     * ReadDaySoccerMatchesValidator constructor.
     *
     * @param LoggerFacade $loggerFacade
     */
    public function __construct(LoggerFacade $loggerFacade)
    {
        $this->loggerFacade = $loggerFacade;
    }

    /**
     * @param array $parameters
     */
    public function apply(array $parameters): void
    {
        $this->validateValidityEnd($parameters);
    }

    /**
     * @param array $parameters
     */
    private function validateValidityEnd(array $parameters): void
    {
        if (empty($parameters['date'])) {
            $errorMessage = SystemMessage::getMessage(SystemMessage::REQUIRED_PARAMETER_ERROR, ['date']);
            $this->loggerFacade->getLogger()->error($errorMessage);
            throw new InvalidArgumentException($errorMessage, 422);
        }

        if (!Validator::date()->validate($parameters['date'])) {
            $errorMessage = SystemMessage::getMessage(SystemMessage::INVALID_PARAMETER_VALUE_ERROR, ['date']);
            $this->loggerFacade->getLogger()->error($errorMessage);
            throw new InvalidArgumentException($errorMessage, 422);
        }
    }
}
