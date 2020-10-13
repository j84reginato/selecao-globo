<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\CLI\Matches;

use DateTime;
use Exception;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Finder\MatchesFinder;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;
use SelecaoGlobo\Infrastructure\ServiceBus\CommandHandler\SimpleCommandHandler;

/**
 * Class MatchesHandler
 */
final class MatchesHandler extends SimpleCommandHandler
{
    /**
     * @var ReadRequest
     */
    private ReadRequest $request;

    /**
     * @var MatchesFinder
     */
    private MatchesFinder $matchFinder;

    /**
     * MatchesHandler constructor.
     *
     * @param ReadRequest   $request
     * @param MatchesFinder $matchFinder
     */
    public function __construct(
        ReadRequest $request,
        MatchesFinder $matchFinder
    ) {
        $this->request     = $request;
        $this->matchFinder = $matchFinder;
    }

    /**
     * @param MatchesCommand $command
     *
     * @throws Exception
     */
    public function handleMatchesCommand(MatchesCommand $command): void
    {
        $firstDay = new DateTime($command->getInitialDate());
        $lastDay  = new DateTime($command->getFinalDate());

        for ($date = $firstDay; $date <= $lastDay; $date->modify('+1 day')) {
            $this->request->setAttribute($date->format('Y-m-d'));
            $response = $this->matchFinder->getList($this->request);

            if (!$response) {
                echo 'Communication error with the API!';
            }
        }
    }
}
