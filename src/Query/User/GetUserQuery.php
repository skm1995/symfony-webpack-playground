<?php

namespace App\Query\User;

use App\Query\QueryInterface;

readonly class GetUserQuery implements QueryInterface
{
    public function __construct(
        private string $userIdentifier
    ) {
    }

    public static function create(string $userIdentifier): self
    {
        return new self($userIdentifier);
    }

    public function getUserIdentifier(): string
    {
        return $this->userIdentifier;
    }
}
