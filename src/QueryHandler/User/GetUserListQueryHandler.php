<?php

namespace App\QueryHandler\User;

use App\Query\User\GetUserListQuery;
use App\QueryHandler\QueryHandlerInterface;
use App\QueryResponse\QueryResponseInterface;
use App\QueryResponse\User\GetUserListQueryResponse;

readonly class GetUserListQueryHandler implements QueryHandlerInterface
{
    public function __invoke(GetUserListQuery $query): QueryResponseInterface
    {
        // Mock data - no DB fetch for now
        $userData = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'admin'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'user'],
            ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com', 'role' => 'user'],
        ];

        return new GetUserListQueryResponse($userData);
    }
}
