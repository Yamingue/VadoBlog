<?php

namespace App\Repository;

use App\Entity\Newslater;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Newslater|null find($id, $lockMode = null, $lockVersion = null)
 * @method Newslater|null findOneBy(array $criteria, array $orderBy = null)
 * @method Newslater[]    findAll()
 * @method Newslater[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewslaterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Newslater::class);
    }

    // /**
    //  * @return Newslater[] Returns an array of Newslater objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Newslater
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
