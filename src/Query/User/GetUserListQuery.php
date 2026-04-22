<?php

namespace App\Query\User;

use App\Query\QueryInterface;

readonly class GetUserListQuery implements QueryInterface
{
    public static function create(): self
    {
        return new self();
    }
}
