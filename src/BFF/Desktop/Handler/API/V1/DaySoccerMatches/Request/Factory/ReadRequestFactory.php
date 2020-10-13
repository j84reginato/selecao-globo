<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\Factory;

use Psr\Container\ContainerInterface;
use SelecaoGlobo\BFF\Desktop\Domain\Service\InputFilter\DaySoccerMatches\ReadFilter;
use SelecaoGlobo\BFF\Desktop\Domain\Service\InputValidator\DaySoccerMatches\ReadValidator;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;
use SelecaoGlobo\Infrastructure\Domain\Service\InputFilter\Iterator\Common\CommonInputFilterIterator;
use SelecaoGlobo\Infrastructure\Domain\Service\InputValidator\Iterator\Common\CommonInputValidatorIterator;
use SelecaoGlobo\Infrastructure\Handler\API\RequestInterface;

/**
 * Class ReadRequestFactory
 */
final class ReadRequestFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return RequestInterface
     */
    public function __invoke(ContainerInterface $container): RequestInterface
    {
        /** @var CommonInputFilterIterator $filterIterator */
        $filterIterator = $container->get(CommonInputFilterIterator::class);
        $filterIterator->addFilter($container->get(ReadFilter::class));

        /** @var CommonInputValidatorIterator $validatorIterator */
        $validatorIterator = $container->get(CommonInputValidatorIterator::class);
        $validatorIterator->addValidator($container->get(ReadValidator::class));

        return new ReadRequest($filterIterator, $validatorIterator);
    }
}
