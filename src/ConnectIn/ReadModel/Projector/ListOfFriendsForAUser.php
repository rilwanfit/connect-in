<?php
declare(strict_types=1);

namespace ConnectIn\ReadModel\Projector;

use Broadway\ReadModel\Projector;
use Broadway\ReadModel\Repository;
use ConnectIn\Event\FriendWasAdded;
use ConnectIn\ReadModel\Repository\ListOfFriendsForAUser as ListOfFriendsForAUserRepository;

class ListOfFriendsForAUser extends Projector
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    protected function applyFriendWasAdded(FriendWasAdded $event)
    {
        $userId = $event->getUser()->getUserId();

        $readModel = $this->getReadModel($userId->__toString());

        $readModel->addFriend($event->getFriend());

        $this->repository->save($readModel);
    }

    private function getReadModel(string $userId)
    {
        $readModel = $this->repository->find($userId);
        if (null === $readModel) {
            $readModel = new ListOfFriendsForAUserRepository($userId);
        }

        return $readModel;
    }
}
