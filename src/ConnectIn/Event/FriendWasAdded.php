<?php
declare(strict_types=1);

namespace ConnectIn\Event;

use ConnectIn\User;
use ConnectIn\UserId;

class FriendWasAdded extends UserEvent
{
    private $friend;

    public function __construct(User $user, User $friend)
    {
        parent::__construct($user);

        $this->friend = $friend;
    }

    public function getFriend(): User
    {
        return $this->friend;
    }

    public static function deserialize(array $data)
    {
        return new self(
            new User(new UserId($data['userId'])),
            new User(new UserId($data['friendId']), $data['friendName'])
        );
    }

    public function serialize(): array
    {
        return array_merge(parent::serialize(), [
            'userId'   => (string) $this->getUser()->getUserId(),
            'friendId' => (string) $this->getFriend()->getUserId(),
            'friendName' => (string) $this->getFriend()->getName(),
        ]);
    }
}
