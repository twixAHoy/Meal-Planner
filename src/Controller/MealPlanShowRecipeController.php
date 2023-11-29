<?php

namespace App\Controller;

use App\Repository\RecipesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MealPlanShowRecipeController extends AbstractController{

    private RecipesRepository $recipeRepo;
    public MealPlanAddNewRecipeToMealController $addNewRecipeController;

    public function __construct(RecipesRepository $recipesRepository, MealPlanAddNewRecipeToMealController $mealPlanAddNewRecipeToMealController){
        $this->recipeRepo = $recipesRepository;
        $this->addNewRecipeController = $mealPlanAddNewRecipeToMealController;
    }

    #[Route('/recipe/meal/{id}', name:'meal_recipe', method: ['GET'])]
    public function showRecipeForSpecificMeal(Request $request){
        $mealID = $request->attributes->get('id');
        $response = $this->recipeRepo->getRecipeSteps($mealID);
        var_dump($response);
        if(!empty($response)){
        return $this->render('recipes/recipe-meal-show.html.twig', [
            'recipe' => $response
        ]);
        }else{
           return $this->addNewRecipeController->createNewRecipe($request, $mealID);
        }
    }
}