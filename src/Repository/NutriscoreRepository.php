<?php

namespace App\Repository;

use App\Entity\Nutriscore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Nutriscore>
 *
 * @method Nutriscore|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nutriscore|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nutriscore[]    findAll()
 * @method Nutriscore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NutriscoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nutriscore::class);
    }

//    /**
//     * @return Nutriscore[] Returns an array of Nutriscore objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Nutriscore
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
