<?php

namespace App\QueryResponse\User;

use App\QueryResponse\QueryResponseInterface;

readonly class GetUserListQueryResponse implements QueryResponseInterface
{
    /**
     * @param array<int, array<string, mixed>> $users
     */
    public function __construct(
        private array $users
    ) {
    }

    public function toArray(): array
    {
        return $this->users;
    }
}
