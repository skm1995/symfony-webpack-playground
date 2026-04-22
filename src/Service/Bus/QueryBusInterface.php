<?php

namespace App\Service\Bus;

use App\Query\QueryInterface;
use App\QueryResponse\QueryResponseInterface;

interface QueryBusInterface
{
    public function ask(QueryInterface $query): QueryResponseInterface;
}
