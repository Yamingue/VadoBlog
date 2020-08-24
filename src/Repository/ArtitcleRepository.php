<?php

namespace App\Repository;

use App\Entity\Artitcle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Artitcle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artitcle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artitcle[]    findAll()
 * @method Artitcle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtitcleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artitcle::class);
    }

    // /**
    //  * @return Artitcle[] Returns an array of Artitcle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Artitcle
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
