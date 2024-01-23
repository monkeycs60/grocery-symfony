<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

        // Trouver une catégorie par son nom
      public function findByName(string $name): ?Category
    {
        return $this->createQueryBuilder('c')
            ->where('c.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }


     // Trouver tous les produits appartenant à une catégorie et à ses sous-catégories
    public function findProductsByCategoryAndSubcategories(string $categoryName): array
    {
        // Récupérer la catégorie principale
        $category = $this->findOneBy(['name' => $categoryName]);

        if (!$category) {
            return [];
        }

        // Initialiser un tableau pour stocker les IDs des catégories
        $categoriesIds = [$category->getId()];

        // Récupérer récursivement tous les IDs des sous-catégories
        $this->addChildCategoryIds($category, $categoriesIds);

        // Utiliser les IDs pour récupérer les produits
        $qb = $this->_em->createQueryBuilder();
        $qb->select('p')
           ->from('App\Entity\Product', 'p')
           ->where($qb->expr()->in('p.category', $categoriesIds));

        return $qb->getQuery()->getResult();
    }

    private function addChildCategoryIds(Category $category, array &$categoriesIds)
    {
        foreach ($category->getCategories() as $childCategory) {
            $categoriesIds[] = $childCategory->getId();
            $this->addChildCategoryIds($childCategory, $categoriesIds);
        }
    }
//    /**
//     * @return Category[] Returns an array of Category objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Category
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
