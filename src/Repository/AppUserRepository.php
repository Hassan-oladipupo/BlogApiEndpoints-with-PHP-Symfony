<?php

namespace App\Repository;

use App\Entity\AppUser;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @extends ServiceEntityRepository<Appuser>
 *
 * @method AppUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppUser[]    findAll()
 * @method AppUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appuser::class);
    }


    public function save(AppUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AppUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof AppUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);

        $this->save($user, true);
    }

    public function findOneByUsername(string $username): ?AppUser
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.userProfile', 'p')
            ->addSelect('p')
            ->where('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Find the usernames of users that the current user is following.
     *
     * @param int $userId The ID of the user whose following list we want to retrieve.
     * @return array
     */
    public function findFollowingUsernames(int $userId): array
    {
        return $this->createQueryBuilder('u')
            ->select('f.username')
            ->innerJoin('u.follow', 'f')
            ->where('u.id = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * Find the usernames of users who follow the specified user.
     *
     * @param int $userId The ID of the user whose followers we want to retrieve.
     * @return array
     */
    public function findFollowerUsernames(int $userId): array
    {
        return $this->createQueryBuilder('u')
            ->select('f.username')
            ->innerJoin('u.followers', 'f') 
            ->where('u.id = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getArrayResult(); 
    }



    //    /**
    //     * @return User[] Returns an array of User objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}


//    /**
//     * @return Appuser[] Returns an array of Appuser objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Appuser
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
