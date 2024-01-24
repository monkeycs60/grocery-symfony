<?php

namespace App\Repository;

use App\Entity\DeliveryInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DeliveryInfo>
 *
 * @method DeliveryInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeliveryInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeliveryInfo[]    findAll()
 * @method DeliveryInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliveryInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeliveryInfo::class);
    }

//    /**
//     * @return DeliveryInfo[] Returns an array of DeliveryInfo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DeliveryInfo
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
