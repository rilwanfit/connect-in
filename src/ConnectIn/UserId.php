<?php
declare(strict_types=1);

namespace ConnectIn;

use Assert\Assertion as Assert;

final class UserId implements Identifier
{
    private $userId;

    public function __construct(string $userId)
    {
        Assert::uuid($userId);

        $this->userId = $userId;
    }

    public function __toString(): string
    {
        return $this->userId;
    }
}
