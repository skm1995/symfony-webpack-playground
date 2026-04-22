<?php

namespace App\CommandResponse;

readonly class CommandResponse implements CommandResponseInterface
{
    public function __construct(
        private mixed $data = null,
    ) {
    }

    public static function create(mixed $data = null): self
    {
        return new self($data);
    }

    public function getData(): mixed
    {
        return $this->data;
    }
}
