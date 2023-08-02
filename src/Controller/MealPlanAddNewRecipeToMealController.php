<?php

namespace App\Controller;

use App\Repository\MealsRepository;
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

    //function to create a new recipes
    #[Route('/meal/{mealID}/add-new-recipe', name:'add_new_recipe', methods:['GET'])]
    public function createNewRecipe(Request $request): Response{
        //get meal id from request to insert into recipe table 
       // $mealID = $request->attributes->get('mealID');

        //check if meal id exists already in recipe table. if it does, this should fail
        if($this->recipesEntity->getMealID()){
            return new Exception();
        }

        //create new recipe
        $recipe = new Recipes();
        $form = $this->createForm(RecipesAddFormType::class, $recipe);
        $form->handleRequest($request);

        var_dump($form->getData());
        

        if($form->isSubmitted() && $form->isValid()){
            var_dump("here");
            $newRecipe = $form->getData();
            if(is_null($newRecipe['recipeStep'])){
                throw new RuntimeException();
            }

            $this->recipeRepository->addNewRecipeToMeal($newRecipe);
            //redirect to route that shows specific meal that was updated with new recipe
        }

        return $this->render('recipes/meal-recipe-add-new.html.twig',[
            'form' => $form
        ]);



        
    }
}