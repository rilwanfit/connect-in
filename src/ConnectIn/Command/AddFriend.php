<?php
declare(strict_types=1);

namespace ConnectIn\Command;

use ConnectIn\User;
use ConnectIn\UserId;

class AddFriend extends UserCommand
{
    /** @var User */
    private $friend;

    public function __construct(UserId $userId, User $friend)
    {
        parent::__construct(new User($userId));

        $this->friend = $friend;
    }

    public function getFriend(): User
    {
        return $this->friend;
    }
}
