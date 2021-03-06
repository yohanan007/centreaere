<?php

namespace App\Repository;

use App\Entity\Parents;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Parents|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parents|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parents[]    findAll()
 * @method Parents[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParentsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Parents::class);
    }

    // /**
    //  * @return Parents[] Returns an array of Parents objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findByIdUserInfoAssociation($id)
    {
        return $this->createQueryBuilder('p')
        ->join('p.parentsAssociations', 'pa')
        ->andWhere('p.utilisateur = :val')
        ->setParameter('val',$id)
        ->addSelect('pa')
        ->join('pa.associations','a')
        ->addSelect('a')
        ->getQuery()
        ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Parents
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllParentByIdUser(int $id)
    {
        return $this->createQueryBuilder('p')
            ->join('p.parentsAssociations','pa')
            ->addSelect('pa')
            ->join('pa.associations','a')
            ->addSelect('a')
            ->join('a.administrateurs','admin')
            ->addSelect('admin')
            ->andWhere('admin.users = :val')
            ->setParameter('val',$id)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findParentByIdUser(int $id)
    {
        return $this->createQueryBuilder('p')
        ->andwhere('p.utilisateur = :var')
        ->setParameter('var',$id)
        ->getQuery()
        ->getResult()
        ;
    }
}
