<?php

namespace App\Repository;

use App\Entity\Evenementiels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Evenementiels|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenementiels|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenementiels[]    findAll()
 * @method Evenementiels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementielsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Evenementiels::class);
    }

    // /**
    //  * @return Evenementiels[] Returns an array of Evenementiels objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Evenementiels
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
