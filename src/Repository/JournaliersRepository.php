<?php

namespace App\Repository;

use App\Entity\Journaliers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Journaliers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Journaliers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Journaliers[]    findAll()
 * @method Journaliers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JournaliersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Journaliers::class);
    }

    // /**
    //  * @return Journaliers[] Returns an array of Journaliers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Journaliers
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
