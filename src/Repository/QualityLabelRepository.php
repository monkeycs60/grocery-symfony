<?php

namespace App\Repository;

use App\Entity\QualityLabel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QualityLabel>
 *
 * @method QualityLabel|null find($id, $lockMode = null, $lockVersion = null)
 * @method QualityLabel|null findOneBy(array $criteria, array $orderBy = null)
 * @method QualityLabel[]    findAll()
 * @method QualityLabel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QualityLabelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QualityLabel::class);
    }

//    /**
//     * @return QualityLabel[] Returns an array of QualityLabel objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?QualityLabel
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
