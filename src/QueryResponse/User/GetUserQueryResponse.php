<?php

namespace App\QueryResponse\User;

use App\Entity\User;
use App\QueryResponse\QueryResponseInterface;

class GetUserQueryResponse implements QueryResponseInterface
{
    private const string EMAIL_KEY = 'email';

    public function __construct(
        private readonly string $email,
    ) {
    }

    public static function createFromEntity(User $user): self
    {
        return new self($user->getEmail());
    }

    public function toArray(): array
    {
        return [
            self::EMAIL_KEY => $this->email,
        ];
    }
}
