<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches\ReadFilter;
use SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Filter\InputFilterInterface;
use SelecaoGlobo\Infrastructure\Logger\Logger\LoggerFacade;

/**
 * Class ReadFilterFactory
 */
final class ReadFilterFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return InputFilterInterface
     */
    public function __invoke(ContainerInterface $container): InputFilterInterface
    {
        return new ReadFilter(
            $container->get(LoggerFacade::ELASTICSEARCH)
        );
    }
}
