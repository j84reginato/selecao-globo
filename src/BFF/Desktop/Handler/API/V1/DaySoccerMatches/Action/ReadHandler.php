<?php

declare(strict_types=1);

namespace SelecaoGlobo\BFF\Desktop\Handler\API\V1\DaySoccerMatches\Action;

use Psr\Http\Server\RequestHandlerInterface;
use SelecaoGlobo\Infrastructure\Domain\Enums\SystemMessage;
use SelecaoGlobo\Infrastructure\Handler\API\AbstractHandler;

/**
 * Class ReadHandler
 */
final class ReadHandler extends AbstractHandler implements RequestHandlerInterface
{
    /**
     * @var string
     */
    protected string $source = self::class;

    /**
     * @var int
     */
    protected int $successMessageCode = SystemMessage::READ_SUCCESS;

    /**
     * @var string
     */
    protected string $successMessageParam = 'soccer matches of day';

    /**
     * @var int
     */
    protected int $successStatusCode = 200;
}
