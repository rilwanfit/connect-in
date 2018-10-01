<?php
declare(strict_types=1);

namespace ConnectIn;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use ConnectIn\Event\FriendWasAdded;
use ConnectIn\Event\UserWasCreated;

final class UserAggregateRoot extends EventSourcedAggregateRoot
{
    /** @var User */
    private $user;

    public static function createAUser(User $user): UserAggregateRoot
    {
        $userAggregateRoot = new UserAggregateRoot();
        $userAggregateRoot->create($user);

        return $userAggregateRoot;
    }

    protected function applyUserWasCreated(UserWasCreated $event)
    {
        $this->user = $event->getUser();
    }

    public function addFriend(User $user)
    {
        $this->apply(new FriendWasAdded($this->user, $user));
    }

    protected function applyFriendWasAdded(FriendWasAdded $event)
    {
    }

    public function getAggregateRootId(): string
    {
        return $this->user->getUserId()->__toString();
    }

    public function getUser()
    {
        return $this->user;
    }

    private function create(User $user)
    {
        $this->apply(new UserWasCreated($user));
    }
}

