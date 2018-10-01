<?php
declare(strict_types=1);

namespace ConnectIn\Command;

use ConnectIn\hasUser;
use ConnectIn\User;

abstract class UserCommand
{
    use hasUser;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
