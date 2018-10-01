<?php
declare(strict_types=1);

namespace ConnectIn\ReadModel\Repository;

use Broadway\ReadModel\SerializableReadModel;
use ConnectIn\User;

class ListOfFriendsForAUser implements SerializableReadModel
{
    private $friends = [];

    private $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function getId(): string
    {
        return $this->userId;
    }

    public function addFriend(User $user)
    {
        $userId = $user->getUserId()->__toString();
        if (isset($this->friends[$userId])) {
            return;
        }

        $this->friends[$userId] = [
            'userId' => $userId,
            'name' => $user->getName()
        ];
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        $readModel = new self($data['userId']);

        $readModel->friends = $data['friends'];

        return $readModel;
    }

    public function serialize(): array
    {
        return [
            'userId' => $this->getId(),
            'friends' => $this->friends,
        ];
    }
}
