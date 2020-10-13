<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Domain\Service\Hydrator;

use Exception;
use SelecaoGlobo\BFF\Desktop\Domain\Service\Hydrator\MatchesHydrator;
use SelecaoGlobo\Unit\AbstractUnitTestCase;
use SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\Service\Hydrator\MatchesHydratorMock;

/**
 * Class MatchHydratorTest
 */
class MatchHydratorTest extends AbstractUnitTestCase
{
    /**
     * @var MatchesHydrator
     */
    protected MatchesHydrator $matchesHydrator;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->matchesHydrator = (new MatchesHydratorMock($this->loggerFacade))->getObjectWithMockDependencies();
    }

    /**
     * @dataProvider getData
     *
     * @param array $matches
     * @param array $references
     *
     * @return void
     * @throws Exception
     */
    public function testList(array $matches, array $references): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf(
                "Testing the method %s with parameters: %s, %s",
                __METHOD__,
                json_encode($matches, JSON_THROW_ON_ERROR),
                json_encode($references, JSON_THROW_ON_ERROR)
            )
        );

        $rule = $this->matchesHydrator->hydrate($matches, $references);

        self::assertIsArray($rule);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $data = require APP_ROOT . '/test/datasources/sports.api.response.php';

        return [
            [
                $data['resultados']['jogos'], $data['referencias']
            ],
        ];
    }
}
