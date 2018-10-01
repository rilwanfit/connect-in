<?php
declare(strict_types=1);

namespace ConnectIn\Event;

use Broadway\Serializer\Serializable;
use ConnectIn\hasUser;
use ConnectIn\User;

abstract class UserEvent implements Serializable
{
    use hasUser;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function serialize(): array
    {
        return [
            'userId' => (string) $this->user->getUserId(),
            'name' => (string) $this->user->getName(),
            'source' => null,
        ];
    }
}
