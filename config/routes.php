<?php

declare(strict_types=1);

use Mezzio\Application;
use OpenApi\Annotations as OA;
use SelecaoGlobo\BFF\Desktop\Handler\API as DesktopAPI;
use SelecaoGlobo\BFF\Desktop\Handler\HTML;

/**
 * @OA\Info(
 *     title="SelecaoGlobo",
 *     description="Aplicação do tipo BFF (backend for frontend) responsável por prover dados para que seus clientes possam montar uma página de calendário de jogos do ano de 2019.",
 *     version="0.1",
 * )
 *
 * @param Application $app
 */
return static function (Application $app) {

    /** HTML */
    $app->get('/', HTML\HomePageHandler::class, 'home');
    $app->get('/resources', HTML\ResourcesHandler::class, 'resources');
    $app->get('/setup', HTML\SetupHandler::class, 'setup');
    $app->get('/commit-standards', HTML\CommitStandardsHandler::class, 'commit.standards');
    $app->get('/coding-standards', HTML\CodingStandardsHandler::class, 'coding.standards');
    $app->get('/conduct-code', HTML\ConductCodeHandler::class, 'conduct.code');
    $app->get('/todo', HTML\TodoListHandler::class, 'github');
    $app->get('/documentation', HTML\ApiDocHandler::class, 'documentation');
    $app->get('/test-coverage/{type:\w+}', HTML\CoverageHandler::class, 'coverage');
    $app->get('/matches', HTML\MatchesHandler::class, 'matches');

    /** API */
    $app->get('/desktop/alive', DesktopAPI\Internal\AliveHandler::class, 'desktop.alive');

    /**
     * ----------------------------------------------------------------------------------------------------------------
     * @OA\Tag(
     *     name="Jogos do dia - Desktop",
     *     description="Métodos para tratamento dos jogos do dia.",
     * )
     * ----------------------------------------------------------------------------------------------------------------
     */

    /**
     * @OA\Get(
     *     path="/api/desktop/v1/soccer-matches/{date}",
     *     tags={"Jogos do dia - Desktop"},
     *     summary="Consultar jogos",
     *     description="Permite consultar os jogos de futebol em determinada data.",
     *     @OA\Parameter(
     *         name="date",
     *         in="path",
     *         description="Data no formato YYYY-mm-dd",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             format=""
     *         ),
     *     ),
     *     @OA\Response(response="200",
     *         description="Operação realizada com sucesso",
     *         @OA\JsonContent(ref="./schemas.yaml#/components/schemas/MatchesReadResponse")
     *     ),
     *     @OA\Response(response="422", description="Argumento inválido",
     *         @OA\JsonContent(ref="./schemas.yaml#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(response="404", description="Entidade não localizada",
     *         @OA\JsonContent(ref="./schemas.yaml#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(response="400", description="Erro interno",
     *         @OA\JsonContent(ref="./schemas.yaml#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    $app->get(
        '/api/desktop/v1/soccer-matches/{date:[12]\d{3}\-\d{2}\-\d{2}}',
        DesktopAPI\V1\DaySoccerMatches\Action\ReadHandler::class
    );
};
