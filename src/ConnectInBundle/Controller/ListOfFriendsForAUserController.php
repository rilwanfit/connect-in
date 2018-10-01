<?php
declare(strict_types=1);

namespace ConnectInBundle\Controller;

use Broadway\ReadModel\Repository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListOfFriendsForAUserController
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getFriendsAction(Request $request, string $userId)
    {
        $readModel = $this->repository->find($userId);

        if (null === $readModel) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($readModel->serialize());
    }
}
