<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Response;

use Exception;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Finder\MatchesFinder;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Hydrator\MatchesHydrator;
use SelecaoGlobo\BFF\Desktop\Domain\View\MatchView;
use SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Request\ReadRequest;
use SelecaoGlobo\Infrastructure\Handler\API\AbstractResponse;
use SelecaoGlobo\Infrastructure\Handler\API\RequestInterface;

/**
 * Class ReadDaySoccerMatchesResponse
 */
class ReadResponse extends AbstractResponse
{
    /**
     * @var MatchesFinder
     */
    private MatchesFinder $matchesFinder;

    /**
     * @var MatchesHydrator
     */
    private MatchesHydrator $matchesHydrator;

    /**
     * ReadBatchResponse constructor.
     *
     * @param MatchesFinder   $matchesFinder
     * @param MatchesHydrator $matchesHydrator
     */
    public function __construct(
        MatchesFinder $matchesFinder,
        MatchesHydrator $matchesHydrator
    ) {
        $this->matchesFinder   = $matchesFinder;
        $this->matchesHydrator = $matchesHydrator;
    }

    /**
     * @param RequestInterface|ReadRequest $request
     *
     * @return array
     * @throws Exception
     */
    public function process(RequestInterface $request): array
    {
        $matches = $this->matchesFinder->getList($request);
        $matches = $this->matchesHydrator->hydrate($matches['resultados']['jogos'], $matches['referencias']);
        $matches = MatchView::serializeFromArray($matches);

        $matchesByChampionchip = [];
        foreach ($matches as $match) {
            $matchesByChampionchip[$match["campeonato"]][] = $match;
        }

        return $matchesByChampionchip;
    }
}
