<?php

namespace App\Repository;

use App\Entity\TypeActivites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeActivites|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeActivites|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeActivites[]    findAll()
 * @method TypeActivites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeActivitesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeActivites::class);
    }

    // /**
    //  * @return TypeActivites[] Returns an array of TypeActivites objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeActivites
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
