<?php

namespace App\QueryResponse;

interface QueryResponseInterface
{
    /**
     * @return array<array-key, mixed>
     */
    public function toArray(): array;
}
