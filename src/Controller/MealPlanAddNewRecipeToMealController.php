<?php

namespace App\Controller;

use App\Repository\RecipesRepository;
use App\Entity\Recipes;
use App\Form\RecipesAddFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MealPlanAddNewRecipeToMealController extends AbstractController
{
    private RecipesRepository $recipeRepository;
    public Recipes $recipesEntity;

    public function __construct(RecipesRepository $recipesRepository){
        $this->recipeRepository = $recipesRepository;
        $this->recipesEntity = new Recipes();
    }

    #[Route('/meal/{mealID}/new-recipe', name:'add_new_recipe', methods:['GET','POST'])]
    public function createNewRecipe(Request $request, string $mealID): Response{  
        $recipe = new Recipes();
        $recipe->setMealID($mealID);
        $form = $this->createForm(RecipesAddFormType::class, $recipe);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){ 
            $newRecipeData = $form->getData();
            try{
                $this->recipeRepository->addNewRecipeToMeal($newRecipeData);
                $response = new Response('success', Response::HTTP_OK);
                $response->headers->set('Content-Type', 'text/plain');
                return $response;
            }catch(Exception $e){
                return new RuntimeException($e->getMessage());
            }
           return $this->redirectToRoute('show_meals');
        }
        return $this->render('recipes/recipe-add-new.html.twig',[
            'addNewRecipeForm' => $form,
            'mealID' => $mealID
        ]);
    }
}