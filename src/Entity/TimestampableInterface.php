<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

interface TimestampableInterface
{
    public function setCreatedAt(): self;

    public function setUpdatedAt(): self;

    public function getCreatedAt(): \DateTimeInterface;

    public function getUpdatedAt(): \DateTimeInterface;

    #[ORM\PrePersist]
    public function onPrePersist(): void;

    #[ORM\PreUpdate]
    public function onPreUpdate(): void;
}
