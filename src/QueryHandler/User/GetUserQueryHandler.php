<?php

namespace App\QueryHandler\User;

use App\Entity\User;
use App\Query\User\GetUserQuery;
use App\QueryHandler\QueryHandlerInterface;
use App\QueryResponse\QueryResponseInterface;
use App\QueryResponse\User\GetUserQueryResponse;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

readonly class GetUserQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function __invoke(GetUserQuery $query): QueryResponseInterface
    {
        $user = $this->userRepository->findOneByUserIdentifier($query->getUserIdentifier());

        if (! $user instanceof User) {
            throw new UserNotFoundException();
        }

        return GetUserQueryResponse::createFromEntity($user);
    }
}
