<?php

namespace App\Repository;

use App\Entity\SfyCASSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SfyCASSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method SfyCASSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method SfyCASSession[]    findAll()
 * @method SfyCASSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SfyCASSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SfyCASSession::class);
    }

    // /**
    //  * @return SfyCASSession[] Returns an array of SfyCASSession objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SfyCASSession
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
