<?php
declare(strict_types=1);

namespace ConnectIn\Event;

use ConnectIn\User;
use ConnectIn\UserId;

class UserWasCreated extends UserEvent
{
    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new self(new User(
            new UserId($data['userId']),
            $data['name']
        ));
    }
}
