<?php

namespace App\QueryResponse\User;

use App\QueryResponse\QueryResponseInterface;

readonly class GetUserByIdQueryResponse implements QueryResponseInterface
{
    /**
     * @param array<string, mixed>|null $user
     */
    public function __construct(
        private ?array $user = null
    ) {
    }

    public function toArray(): array
    {
        return $this->user ?? [];
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getUser(): ?array
    {
        return $this->user;
    }
}
