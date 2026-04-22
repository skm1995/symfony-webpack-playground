<?php

namespace App\CommandHandler\User;

use App\Command\User\CreateUserCommand;
use App\CommandHandler\CommandHandlerInterface;
use App\CommandResponse\CommandResponse;
use App\CommandResponse\CommandResponseInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $passwordEncoder,
    ) {
    }

    public function __invoke(CreateUserCommand $command): CommandResponseInterface
    {
        $user = new User();
        $user->setEmail($command->getEmail());
        $user->setPassword($this->passwordEncoder->hashPassword($user, $command->getPassword()));
        $user->setIsActive($command->isActive());

        $this->em->persist($user);
        $this->em->flush();

        return CommandResponse::create($user);
    }
}
