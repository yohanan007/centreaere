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


    // parent verifiant toutes les activites  où sont inscrit ses enfant
    // amelioration à faire  via date et select
    public function findAllEnfantsActiviteEnfantByIdUserParent(int $id)
    {
        return $this->createQueryBuilder('a')
        ->join('a.enfants','enf')
        ->addSelect('enf')
        ->join('enf.parents','par')
        ->addSelect('par')
        ->andWhere('par.utilisateur = :val')
        ->setParameter('val',$id)
        ->getQuery()
        ->getResult()
        ;
    }


    // administrateur verifiant tous les enfants inscrits dans une activité d'une association lui  apparetenant
        // amélioration à faire  via date et select
    public function findAllEnfantsInActiviteByIdActivite(int $activite_id, int $user_id)
    {
        return $this->createQueryBuilder('a')
        ->join('a.enfants','enf')
        ->join('a.activtes','acti')
        ->addSelect('acti')
        ->andWhere('acti.id = :value')
        ->setParameter('value',$activite_id)
        ->join('acti.associations','asso')
        ->addSelect('asso')
        ->join('asso.administrateurs','admin')
        ->addSelect('admin')
        ->andWhere('admin.users = :userid')
        ->setParameter('userid',$user_id)
        ->getQuery()
        ->getResult()
        ;

    }
}
