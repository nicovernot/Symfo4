<?php

namespace App\Repository;

use App\Entity\Regle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Regle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Regle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Regle[]    findAll()
 * @method Regle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Regle::class);
    }

    // /**
    //  * @return Regle[] Returns an array of Regle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Regle
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
