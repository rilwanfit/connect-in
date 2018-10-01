<?php
declare(strict_types=1);

namespace ConnectIn\Command;

use Broadway\CommandHandling\SimpleCommandHandler;
use ConnectIn\Repository\UserRepository;
use ConnectIn\UserAggregateRoot;

class UserCommandHandler extends SimpleCommandHandler
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handleCreateAUser(CreateAUser $command)
    {
        $user = UserAggregateRoot::createAUser($command->getUser());

        $this->repository->save($user);
    }

    public function handleAddFriend(AddFriend $command)
    {
        $user = $this->repository->load($command->getUser()->getUserId());

        $user->addFriend($command->getFriend());

        $this->repository->save($user);
    }
}
