<?php

namespace App\Repository;

use App\Entity\Activites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Activites|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activites|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activites[]    findAll()
 * @method Activites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivitesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Activites::class);
    }

    // /**
    //  * @return Activites[] Returns an array of Activites objects
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
    public function findOneBySomeField($value): ?Activites
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByIdUserRoleParent($id)
    {
        return $this->createQueryBuilder('a')
        ->join('a.associations','ass')
        ->addSelect('ass')
        ->join('ass.parentsAssociations','pa')
        ->addSelect('pa')
        ->join('pa.parents','par')
        ->addSelect('par')
        ->join('par.utilisateur','uti')
        ->addSelect('uti')
        ->andWhere('uti.id = :var')
        ->setParameter('var',$id)
        ->getQuery()
        ->getResult()
        ;
    }

    public function findByIdUserRoleAdmin($id)
    {
        return $this->createQueryBuilder('a')
        ->join('a.associations','ass')
        ->addSelect('ass')
        ->join('ass.administrateurs','admin')
        ->addSelect('admin')
        ->join('admin.users','util')
        ->addSelect('util')
        ->andWhere('util.id = :var')
        ->setParameter('var',$id)
        ->getQuery()
        ->getResult()
        ;
    }
}
