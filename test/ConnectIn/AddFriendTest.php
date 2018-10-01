<?php
declare(strict_types=1);

namespace Test\ConnectIn;

use ConnectIn\Command\AddFriend;
use ConnectIn\Event\FriendWasAdded;
use ConnectIn\Event\UserWasCreated;
use ConnectIn\User;
use ConnectIn\UserId;

class AddFriendTest extends UserCommandHandlerTest
{
    /**
     * @test
     */
    public function it_adds_a_friend()
    {
        $userId = new UserId('00000000-0000-0000-0000-000000000000');
        $friendId = new UserId('00000000-0000-0000-0000-000000000001');

        $user = new User($userId);
        $friend = new User($friendId);

        $this->scenario
            ->withAggregateId($userId)
            ->given([
                new UserWasCreated($user),
            ])
            ->when(new AddFriend($userId, $friend))
            ->then([
                new FriendWasAdded($user, $friend)
            ]);
    }
}
