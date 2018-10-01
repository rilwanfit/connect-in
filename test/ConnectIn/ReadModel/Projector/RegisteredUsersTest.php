<?php
declare(strict_types=1);

namespace Test\ConnectIn\ReadModel\Projector;

use Broadway\ReadModel\InMemory\InMemoryRepository;
use Broadway\ReadModel\Testing\ProjectorScenarioTestCase;
use ConnectIn\Event\UserWasCreated;
use ConnectIn\ReadModel\Projector\RegisteredUsers;
use ConnectIn\User;
use ConnectIn\UserId;

class RegisteredUsersTest extends ProjectorScenarioTestCase
{
    protected function createProjector(InMemoryRepository $repository)
    {
        return new RegisteredUsers($repository);
    }

    /**
     * @test
     */
    public function it_creates_a_read_model_when_user_was_created()
    {
        $userId = new UserId('00000000-0000-0000-0000-000000000000');
        $user = new User($userId, 'rilwan');

        $this->scenario->given([])
            ->when(new UserWasCreated($user))
            ->then([
                $this->createReadModel($user),
            ]);
    }

    private function createReadModel(User $user)
    {
        $readModel = new \ConnectIn\ReadModel\Repository\RegisteredUsers($user->getUserId()->__toString());
        $readModel->addUser($user);

        return $readModel;
    }
}
