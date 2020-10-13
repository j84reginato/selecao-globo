<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\BFF\Desktop\Application\Dependency\Infrastructure\ServiceBus;

use SelecaoGlobo\BFF\Desktop\Application\Dependency\Infrastructure\ServiceBus\EventListener;
use SelecaoGlobo\Unit\AbstractUnitTestCase;

/**
 * Class EventListenerTest
 */
class EventListenerTest extends AbstractUnitTestCase
{
    /**
     * @return void
     */
    public function testGetConfig(): void
    {
        $this->loggerFacade->getLogger()->info(
            sprintf("Testing the method %s with parameters: %s", __METHOD__, 'none')
        );

        $dependencies = EventListener::getDependencies();

        self::assertIsArray($dependencies);
    }
}
