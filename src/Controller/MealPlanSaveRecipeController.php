<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecipesRepository;
use Exception;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class MealPlanSaveRecipeController extends AbstractController
{
    private RecipesRepository $recipeRepo;

    public function __construct(RecipesRepository $recipesRepository){
        $this->recipeRepo = $recipesRepository;
    }

    #[Route('/recipe/meal/update/{mealID}', name: 'save_recipe', methods:['POST'])]
    public function updateRecipeStep(Request $request)
    {
        $updatedRecipeData = $request->getContent('recipeSteps');
        $mealID = $request->attributes->get('mealID');
        
        try{
            $this->recipeRepo->updateExistingRecipe($mealID, $updatedRecipeData);
            $response = new Response('success', Response::HTTP_OK);
            $response->headers->set('Content-Type', 'text/plain');
            return $response;
        }catch(Exception $e){
            throw new RuntimeException($e->getMessage());
        }
    }
}
