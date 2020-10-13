<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\Service\InputValidator\DaySoccerMatches\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\InputValidator\DaySoccerMatches\ReadValidator;
use SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Validator\InputValidatorInterface;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;

/**
 * Class ReadValidatorFactory
 */
class ReadValidatorFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return InputValidatorInterface
     */
    public function __invoke(ContainerInterface $container): InputValidatorInterface
    {
        return new ReadValidator(
            $container->get(LoggerFacade::ELASTICSEARCH)
        );
    }
}
