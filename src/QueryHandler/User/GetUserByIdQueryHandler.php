<?php

namespace App\QueryHandler\User;

use App\Query\User\GetUserByIdQuery;
use App\QueryHandler\QueryHandlerInterface;
use App\QueryResponse\QueryResponseInterface;
use App\QueryResponse\User\GetUserByIdQueryResponse;

readonly class GetUserByIdQueryHandler implements QueryHandlerInterface
{
    public function __invoke(GetUserByIdQuery $query): QueryResponseInterface
    {
        // Mock data - no DB fetch for now
        $mockUsers = [
            1 => ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'admin'],
            2 => ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'user'],
        ];

        $userData = $mockUsers[$query->getId()] ?? null;

        return new GetUserByIdQueryResponse($userData);
    }
}
