<?php

namespace App\Service\Bus;

use App\Query\QueryInterface;
use App\QueryResponse\QueryResponseInterface;

/**
 * @template T of QueryResponseInterface
 */
interface QueryBusInterface
{
    public function ask(QueryInterface $query): QueryResponseInterface;
}
