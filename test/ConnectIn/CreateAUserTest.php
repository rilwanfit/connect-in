<?php
declare(strict_types=1);

namespace Test\ConnectIn;


use ConnectIn\Command\CreateAUser;
use ConnectIn\Event\UserWasCreated;
use ConnectIn\User;
use ConnectIn\UserId;

class CreateAUserTest extends UserCommandHandlerTest
{
    /**
     * @test
     */
    public function it_create_a_user()
    {
        $userId = new UserId('00000000-0000-0000-0000-000000000000');
        $user = new User($userId);

        $this->scenario
            ->given([])
            ->when(new CreateAUser($user))
            ->then([
                new UserWasCreated($user)
            ]);
    }
}
