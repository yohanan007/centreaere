<?php

namespace App\Repository;

use App\Entity\Animateurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Animateurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animateurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animateurs[]    findAll()
 * @method Animateurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimateursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Animateurs::class);
    }

    // /**
    //  * @return Animateurs[] Returns an array of Animateurs objects
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
    public function findOneBySomeField($value): ?Animateurs
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
