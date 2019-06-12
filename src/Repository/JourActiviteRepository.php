<?php

namespace App\Repository;

use App\Entity\JourActivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JourActivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method JourActivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method JourActivite[]    findAll()
 * @method JourActivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JourActiviteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JourActivite::class);
    }

    // /**
    //  * @return JourActivite[] Returns an array of JourActivite objects
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
    public function findOneBySomeField($value): ?JourActivite
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
