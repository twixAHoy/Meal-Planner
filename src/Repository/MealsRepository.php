<?php

namespace App\Repository;

use App\Entity\Meals;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityRepository;
use RuntimeException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Error\RuntimeError;

/**
 * @extends ServiceEntityRepository<Meals>
 *
 * @method Meals|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meals|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meals[]    findAll()
 * @method Meals[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MealsRepository extends ServiceEntityRepository
{
    public EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct($registry, Meals::class);
    }
    
    public function showAllMeals()
    {     
        return $this->createQueryBuilder('meals')
                ->getQuery()
                ->execute();
    }

    public function addNewMeal($meal)
    {
        try{
            $this->entityManager->persist($meal);
            $this->entityManager->flush();
            //return $this->redirectToRoute('show_meals');
        }catch(Exception $e){
            return new Response($e->getMessage());
        }
        /*return $this->render('meals-modify.html.twig',[
            'form' => $formData
        ]);*/
    }

    public function showMealsByMealType(string $mealType){

        if(!$mealType){
            throw new RuntimeException();
        }

        try{
            return $this->createQueryBuilder('meals')
            ->where('meals.mealType = :mealType')
            ->setParameter('mealType', $mealType)
            ->getQuery()
            ->execute();
        }catch(RuntimeError $e){
            throw new RuntimeException("There was an error getting the meals. " . $e->getMessage());
        }
    }

      /*#[Route('/search-recipe', name: 'show_searched_recipe')]
    public function showSearchedRecipes(Request $request, $userInput): Response
    {
        return $this->render('recipes/searched-recipes.html.twig');
    }*/


   /* #[Route('/recipes/edit/{id}', name: 'edit_recipe', methods:['GET', 'POST'])]
    public function editRecipe(Request $request, $id):Response
    {
        $recipe = $this->recipeRepository->find($id);
        $form = $this->createForm(EditRecipeFormType::class, $recipe);
        
        $form->handleRequest($request);

        //TODO: fix handling of images
        $imagePath = $form->get('image')->getData();

        if($form->isSubmitted() && $form->isValid()){
            //image update
            if($imagePath){
                if($recipe->getImage() !== null){
                    if(file_exists($this->getParameter('kernel.project_dir') . $recipe->getImage())){
                        $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                        try{
                            $imagePath->move($this->getParameter('kernel.project_dir') . '/public/uploads', $newFileName);
                        }catch(FileException $e){
                            return new Response($e->getMessage());
                        }
                        $recipe->setImage('/uploads/' . $newFileName);
                        $this->em->flush();
                    }
                }
            }
                $recipe->setName($form->get('name')->getData());
                $recipe->setDescription($form->get('description')->getData());
                $recipe->setIngredients($form->get('ingredients')->getData());

                $this->em->flush();
                return $this->redirectToRoute('show_recipes');
        }

        return $this->render('recipes/edit.html.twig',[
            'recipe' => $recipe,
            'form' => $form->createView()
        ]);
    }

    #[Route('/recipes/delete/{id}', name:'delete_recipe')]
    public function deleteRecipe($id): Response{
        $recipe = $this->recipeRepository->find($id);
        $this->em->remove($recipe);
        $this->em->flush();

        return $this->redirectToRoute('show_recipes');
    }

    #[Route('/search-meal', name:'search_filter', methods:['GET'])]
    public function searchForMeal(Request $request){
        $userMealInput = $request->query->get('input');

        $query = $this->entityManagerInterface->createQuery( "SELECT 
               *
         FROM mealPlanner.recipes
         WHERE name = :input");

         $query->setParameter('input', $userMealInput);

         $result = $query->getResult();

        if($result){
            return $this->redirectToRoute('show_searched_recipe');
        }
        return $this->redirectToRoute('show_recipes');
    }*/

//    /**
//     * @return Meals[] Returns an array of Meals objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Meals
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}