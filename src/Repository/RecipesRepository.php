<?php

namespace App\Repository;

use App\Entity\Recipes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipes>
 *
 * @method Recipes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipes[]    findAll()
 * @method Recipes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipesRepository extends ServiceEntityRepository
{

    public EntityManagerInterface $em;
    private MealsRepository $mealRepo;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em, MealsRepository $mealsRepository)
    {
        $this->em = $em;
        $this->mealRepo = $mealsRepository;
        parent::__construct($registry, Recipes::class);
    }

    public function save(Recipes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Recipes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   
    /*public function addRecipeStep(int $mealID, string $recipeStep){

        //find recipe by mealid
        $recipeID = $this->mealRepo->getRecipeID($mealID);

        //get recipe steps into an array
        $recipeSteps = $this->find($recipeID);

        //append recipe step to recipe
        $newRecipeSteps = $recipeSteps;


        //update page using js
    }*/

//    /**
//     * @return Recipes[] Returns an array of Recipes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Recipes
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
