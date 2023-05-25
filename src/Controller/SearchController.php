<?php

namespace App\Controller;

use App\Form\SearchFormType;
use App\Repository\RecipesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    public RecipesController $recipeController;
    private RecipesRepository $recipeRepository;
    private EntityManagerInterface $entityManagerInterface;

    public function __construct(RecipesRepository $recipeRepository, EntityManagerInterface $entityManagerInterface){
        $this->recipeRepository = $recipeRepository;
        $this->entityManagerInterface = $entityManagerInterface; 
    }

    public function showFormInMealsPage(){
        $form = $this->createForm(SearchFormType::class);
        return $form;
    }

    #[Route('/search-meal', name:'search_filter', methods:['GET'])]
    public function searchForMeal($userMealInput, Request $request){
       
        $allMeals = $this->recipeRepository->findAll();
        for($i = 0; $i <= count($allMeals)-1; $i++){
            
        }
    }
}
