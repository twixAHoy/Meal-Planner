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

    public function createNewRecipe(Request $request, string $mealID): Response{
        $recipe = new Recipes();
        $jsonRecipeData = $request->getContent();
        $requestData = json_decode($jsonRecipeData,true);
        $form = $this->createForm(RecipesAddFormType::class, $recipe);

        if (isset($requestData['recipeSteps'])) {
            $//recipeStepsData = $requestData['recipeSteps'];
            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                var_dump("submitted");
                //var_dump($form->getErrors());
                $newRecipeData = $form->getData();
                if(is_null($newRecipeData['recipeStep'])){
                    throw new RuntimeException();
                }
                try{
                    $this->recipeRepository->addNewRecipeToMeal($newRecipeData, $mealID);
                    $response = new Response('success', Response::HTTP_OK);
                    $response->headers->set('Content-Type', 'text/plain');
                    return $response;
                }catch(Exception $e){
                    return new RuntimeException($e->getMessage());
                }
            }
        }
        return $this->render('recipes/recipe-add-new.html.twig',[
            'addNewRecipeForm' => $form
        ]);
        
    }

    #[Route('/meal/{mealID}/new-recipe', name:'add_new_recipe', methods:['POST'])]
    public function createNewRecipe2(Request $request, string $mealID): Response{
        $recipe = new Recipes();
        //$jsonRecipeData = $request->getContent();
        //$requestData = json_decode($jsonRecipeData,true);
        $form = $this->createForm(RecipesAddFormType::class, $recipe);

        //f (isset($requestData['recipeSteps'])) {
            //recipeStepsData = $requestData['recipeSteps'];
            $form->handleRequest($request);
            var_dump($mealID);
            
            if($form->isSubmitted() && $form->isValid()){
                var_dump("submitted");
                //var_dump($form->getErrors());
                $newRecipeData = $form->getData();
                if(is_null($newRecipeData['recipeStep'])){
                    throw new RuntimeException();
                }
                try{
                    $this->recipeRepository->addNewRecipeToMeal($newRecipeData, $mealID);
                    $response = new Response('success', Response::HTTP_OK);
                    $response->headers->set('Content-Type', 'text/plain');
                    return $response;
                }catch(Exception $e){
                    return new RuntimeException($e->getMessage());
                }
            }
       // }
        return $this->render('recipes/recipe-add-new.html.twig',[
            'addNewRecipeForm' => $form
        ]);
        
    }
}