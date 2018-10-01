<?php
declare(strict_types=1);

namespace Test\ConnectIn\ReadModel\Projector;

use Broadway\ReadModel\InMemory\InMemoryRepository;
use Broadway\ReadModel\Testing\ProjectorScenarioTestCase;
use ConnectIn\Event\FriendWasAdded;
use ConnectIn\ReadModel\Projector\ListOfFriendsForAUser;
use ConnectIn\User;
use ConnectIn\UserAggregateRoot;
use ConnectIn\UserId;

class ListOfFriendsForAUserTest extends ProjectorScenarioTestCase
{
    protected function createProjector(InMemoryRepository $repository)
    {
        return new ListOfFriendsForAUser($repository);
    }

    /**
     * @test
     */
    public function it_creates_a_read_model_when_friend_was_added_to_a_user()
    {
        $userId = new UserId('00000000-0000-0000-0000-000000000000');
        $friendId = new UserId('00000000-0000-0000-0000-000000000001');

        $user = new User($userId);
        $friend = new User($friendId, 'rilwan');

        $this->scenario->given([])
            ->when(new FriendWasAdded($user, $friend))
            ->then([
                $this->createReadModel($userId->__toString(), $friend),
            ]);
    }

    private function createReadModel(string $userId, User $friend)
    {
        $readModel = new \ConnectIn\ReadModel\Repository\ListOfFriendsForAUser($userId);
        $readModel->addFriend($friend);

        return $readModel;
    }
}
