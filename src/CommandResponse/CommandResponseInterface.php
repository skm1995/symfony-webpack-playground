<?php

namespace App\CommandResponse;

/**
 * @template T of mixed
 */
interface CommandResponseInterface
{
    /**
     * @return T
     */
    public function getData(): mixed;
}
