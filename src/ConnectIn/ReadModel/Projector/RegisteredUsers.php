<?php
declare(strict_types=1);

namespace ConnectIn\ReadModel\Projector;

use Broadway\ReadModel\Projector;
use Broadway\ReadModel\Repository;
use ConnectIn\Event\UserWasCreated;
use ConnectIn\ReadModel\Repository\RegisteredUsers as RegisteredUsersRepository;

class RegisteredUsers extends Projector
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    protected function applyUserWasCreated(UserWasCreated $event)
    {
        $user = $event->getUser();

        $readModel = $this->getReadModel($user->getUserId()->__toString());

        $readModel->addUser($user);

        $this->repository->save($readModel);
    }

    private function getReadModel(string $userId)
    {
        $readModel = $this->repository->find($userId);

        if (null === $readModel) {
            $readModel = new RegisteredUsersRepository($userId);
        }

        return $readModel;
    }
}
