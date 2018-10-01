<?php
declare(strict_types=1);

namespace ConnectInBundle\Controller;

use Assert\Assertion as Assert;
use Broadway\CommandHandling\CommandBus;
use Broadway\ReadModel\Repository;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use ConnectIn\Command\AddFriend;
use ConnectIn\Command\CreateAUser;
use ConnectIn\Exception\NoRegisteredUserException;
use ConnectIn\Exception\ReadModelNotAvailableException;
use ConnectIn\User;
use ConnectIn\UserId;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

class UserController
{
    private $commandBus;
    private $uuidGenerator;

    /** @var Repository */
    private $userRepository;

    public function __construct(
        CommandBus $commandBus,
        UuidGeneratorInterface $uuidGenerator,
        Repository $userRepository
    ) {
        $this->commandBus    = $commandBus;
        $this->uuidGenerator = $uuidGenerator;
        $this->userRepository = $userRepository;
    }

    public function createAUserAction(Request $request): JsonResponse
    {
        try {
            $userId = new UserId($this->uuidGenerator->generate());
            $name = $request->request->get('name');

            Assert::notNull($name);

            $command  = new CreateAUser(new User($userId, $name));
            $this->commandBus->dispatch($command);

            return new JsonResponse([
                'id' => (string) $userId
            ]);
        } catch (Throwable $exception) {
            return new JsonResponse([
                'status' => 'error',
                'reason' => $exception->getMessage()
            ]);
        }
    }

    public function getUsersAction(Request $request)
    {
        try {
            $readModel = $this->userRepository->findAll();

            if (is_null($readModel)) {
                throw new ReadModelNotAvailableException();
            }

            $registeredUsers = [];
            foreach ($readModel as $item) {
                $registeredUsers[] = $item->serialize()['registeredUsers'];
            }

            return new JsonResponse($registeredUsers);
        } catch (Throwable $exception) {
            return new JsonResponse([
                'status' => 'error',
                'reason' => $exception->getMessage()
            ]);
        }
    }

    public function addFriendAction(Request $request): JsonResponse
    {
        try {
            $userId = $request->request->get('userId');
            $friendId = $request->request->get('friendId');

            Assert::uuid($userId, 'Invalid Id(s)');
            Assert::uuid($friendId, 'Invalid Id(s)');

            $friend = $this->userRepository->find($friendId);

            if (is_null($friend)) {
                throw new NoRegisteredUserException();
            }

            $name = $friend->serialize()['registeredUsers'][$friendId]['name'];

            $command  = new AddFriend(
                new UserId($userId),
                new User(new UserId($friendId), $name)
            );

            $this->commandBus->dispatch($command);

            return new JsonResponse([
                'status' => 'success',
            ]);
        } catch (Throwable $exception) {
            return new JsonResponse([
                'status' => 'error',
                'reason' => $exception->getMessage()
            ]);
        }
    }
}
