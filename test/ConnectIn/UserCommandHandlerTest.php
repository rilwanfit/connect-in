<?php
declare(strict_types=1);

namespace Test\ConnectIn;

use Broadway\CommandHandling\Testing\CommandHandlerScenarioTestCase;
use Broadway\EventHandling\EventBus;
use Broadway\EventStore\EventStore;
use ConnectIn\Command\UserCommandHandler;
use ConnectIn\Repository\UserRepository;

abstract class UserCommandHandlerTest extends CommandHandlerScenarioTestCase
{
    protected function createCommandHandler(EventStore $eventStore, EventBus $eventBus)
    {
        return new UserCommandHandler(
            new UserRepository($eventStore, $eventBus)
        );
    }
}
