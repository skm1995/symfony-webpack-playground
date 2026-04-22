<?php

namespace App\CommandResponse;

/**
 * @template T of mixed
 * @implements CommandResponseInterface<T>
 */
readonly class CommandResponse implements CommandResponseInterface
{
    /**
     * @param T $data
     */
    public function __construct(
        private mixed $data = null,
    ) {
    }

    /**
     * @param T $data
     * @return CommandResponse<T>
     */
    public static function create(mixed $data = null): self
    {
        return new self($data);
    }

    /**
     * @return T
     */
    public function getData(): mixed
    {
        return $this->data;
    }
}
