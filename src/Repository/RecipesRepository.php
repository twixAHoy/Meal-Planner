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
    public EntityManagerInterface $entityManager;
    //public $repository = $this;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct($registry, Recipes::class);
    }

    public function addNewRecipeToMeal($newRecipeData, $mealID){
        if(is_array($newRecipeData) || is_object($newRecipeData)){
            foreach ($newRecipeData as $data) {
                $newRecipe = new Recipes();
                $newRecipeStepId = $data['recipeStepId'];
                $newRecipeDescription = $data['recipeStepDesc'];

                $newRecipe->setMealID($mealID);
                $newRecipe->setRecipeStepID($newRecipeStepId);
                $newRecipe->setRecipeStep($newRecipeDescription);

                try{
                    $this->entityManager->persist($newRecipe);
                    $this->entityManager->flush();
                }catch(Exception $e){
                    return $this->logger->error('Exception occurred: ' . $e->getMessage());
                }    
            }
        }  
    }

    public function getRecipeSteps($mealID){
        $repository = $this;
        $queryBuilder = $repository->createQueryBuilder('recipes')
        ->where('recipes.mealID = :mealID')
        ->setParameter('mealID', $mealID);

        $results = $queryBuilder->getQuery()->getResult();
        return $results;
    }

    public function updateExistingRecipe($mealID, $newRecipeSteps){
        $repository = $this;

        if(is_array($newRecipeSteps) || is_object($newRecipeSteps)){
            $em = $this->entityManager;
            foreach ($newRecipeSteps as $data) {
                $recipeStepIdToUpdate = $data['recipeStepId'];
                $newRecipeDescription = $data['recipeStepDesc'];
    
                $repository->createQueryBuilder('recipes')
                ->update(Recipes::class, 'recipes')
                //->update(Recipes, 'recipes')
                ->set('recipes.recipe_steps', ':newStepDesc')
                ->where('recipes.mealID = :mealID')
                ->andWhere('recipes.recipeStepID = :recipeStepId')
                ->setParameter('newStep', $newRecipeDescription)
                ->setParameter('recipeStepId', $recipeStepIdToUpdate)
                ->setParameter('mealID', $mealID) 
                ->getQuery()
                ->execute();
            }

            //persist changes   
            $em->flush();
        }
        
    }
    
   
}
