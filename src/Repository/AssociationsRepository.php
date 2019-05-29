<?php

namespace App\Repository;

use App\Entity\Associations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Associations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Associations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Associations[]    findAll()
 * @method Associations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Associations::class);
    }

    // /**
    //  * @return Associations[] Returns an array of Associations objects
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

    public function findByAdministrateurId($id) : ?Associations
    {
        return $this->createQueryBuilder('a')
        ->andWhere('a.administateurs_id = :val')
        ->setParameter('val',$id)
        ->getQuery()
        ->getResult();
    }

   
    public function findByUserIdRoleAdministrateur($id) 
    {
        return $this->createQueryBuilder('a')
        ->join('a.administrateurs','ad')
        ->where('ad.users = :val')
        ->setParameter('val',$id)
        ->getQuery()
        ->getResult();
    }
    /*
    public function findOneBySomeField($value): ?Associations
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
