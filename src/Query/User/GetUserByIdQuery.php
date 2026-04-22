<?php

namespace App\Query\User;

use App\Query\QueryInterface;

readonly class GetUserByIdQuery implements QueryInterface
{
    public function __construct(
        private int $id
    ) {
    }

    public static function create(int $id): self
    {
        return new self($id);
    }

    public function getId(): int
    {
        return $this->id;
    }
}
