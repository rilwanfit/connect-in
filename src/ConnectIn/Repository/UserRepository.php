<?php
declare(strict_types=1);

namespace ConnectIn\Repository;

use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStore;
use ConnectIn\UserAggregateRoot;

class UserRepository extends EventSourcingRepository
{
    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus,
        array $eventStreamDecorators = array()
    ) {
        parent::__construct(
            $eventStore,
            $eventBus,
           UserAggregateRoot::class,
            new PublicConstructorAggregateFactory(),
            $eventStreamDecorators
        );
    }
}

