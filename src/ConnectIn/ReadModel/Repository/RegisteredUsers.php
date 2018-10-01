<?php
declare(strict_types=1);

namespace ConnectIn\ReadModel\Repository;

use Broadway\ReadModel\SerializableReadModel;

class RegisteredUsers implements SerializableReadModel
{
    /** @var string */
    private $userId;

    /** @var array */
    private $registeredUsers = [];

    public function __construct(string $userId = null)
    {
        $this->userId = $userId;
    }

    public function getId(): string
    {
        return $this->userId;
    }

    public function addUser(\ConnectIn\User $user)
    {
        $userId = $user->getUserId()->__toString();

        if (isset($this->registeredUsers[$userId])) {
            return;
        }

        $this->registeredUsers[$userId] = [
            'id' => (string) $user->getUserId(),
            'name' => (string) $user->getName(),
        ];
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        $readModel = new self($data['userId']);

        $readModel->registeredUsers = $data['registeredUsers'];

        return $readModel;
    }

    public function serialize(): array
    {
        return [
            'registeredUsers' => $this->registeredUsers,
        ];
    }
}
