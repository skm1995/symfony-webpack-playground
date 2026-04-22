<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    private const string USER_IDENTIFIER_WHERE_FORMAT = 'u.%s = :userIdentifier';
    private const string UNEXPECTED_USER_INSTANCE_MESSAGE = 'Instances of "%s" are not supported.';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf(self::UNEXPECTED_USER_INSTANCE_MESSAGE, $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function findOneByUserIdentifier(string $userIdentifier): ?User
    {
        $qb = $this
            ->createQueryBuilder('u')
            ->where(sprintf(self::USER_IDENTIFIER_WHERE_FORMAT, User::USER_IDENTIFIER_FIELD))
            ->setParameter('userIdentifier', $userIdentifier)
        ;

        return $qb->getQuery()->getOneOrNullResult(Query::HYDRATE_OBJECT);
    }

    public function findOneByConnectionId(string $connectionId, string $connectionClassName): ?User
    {
        $qb = $this
            ->createQueryBuilder('u')
            ->join($connectionClassName, 'uc')
            ->where('uc.connectionId = :connectionId')
            ->setParameter('connectionId', $connectionId)
        ;

        $result =  $qb->getQuery()->getOneOrNullResult(Query::HYDRATE_OBJECT);

        if ($result instanceof User) {
            return $result;
        }

        return null;
    }
}
