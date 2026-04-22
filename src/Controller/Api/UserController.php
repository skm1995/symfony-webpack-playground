<?php

namespace App\Controller\Api;

use App\Query\User\GetUserByIdQuery;
use App\Query\User\GetUserListQuery;
use App\QueryResponse\User\GetUserByIdQueryResponse;
use App\Service\Bus\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/users')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    #[Route('', name: 'api_users_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $query = GetUserListQuery::create();
        $response = $this->queryBus->ask($query);

        return $this->json($response->toArray());
    }

    #[Route('/{id}', name: 'api_users_get', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $query = GetUserByIdQuery::create($id);
        /** @var GetUserByIdQueryResponse $response */
        $response = $this->queryBus->ask($query);

        if ($response->getUser() === null) {
            return $this->json(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($response->toArray());
    }
}
