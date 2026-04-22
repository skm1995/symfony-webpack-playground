<?php

namespace App\Command\User;

use App\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateUserCommand implements CommandInterface
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Email]
        private string $email,
        #[Assert\NotBlank]
        #[Assert\PasswordStrength]
        private string $password,
        #[Assert\IsFalse]
        private bool $isActive = false,
    ) {
    }

    public static function create(string $email, string $password, bool $isActive = false): self
    {
        return new self($email, $password, $isActive);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }
}
