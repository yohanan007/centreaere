<?php

namespace App\Repository;

use App\Entity\ActivitesEnfants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ActivitesEnfants|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActivitesEnfants|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActivitesEnfants[]    findAll()
 * @method ActivitesEnfants[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivitesEnfantsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ActivitesEnfants::class);
    }

    // /**
    //  * @return ActivitesEnfants[] Returns an array of ActivitesEnfants objects
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
    public function findOneBySomeField($value): ?ActivitesEnfants
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
