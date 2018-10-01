<?php
declare(strict_types=1);

namespace ConnectIn;

class User
{
    /** @var UserId */
    private $userId;

    /** @var string */
    private $name;

    public function __construct(UserId $userId, string $name = null)
    {
        $this->userId = $userId;
        $this->name = $name;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
