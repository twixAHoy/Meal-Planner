<?php

namespace App\Controller;

use App\Repository\RecipesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    public RecipesController $recipeController;
    private RecipesRepository $recipeRepository;
    private EntityManagerInterface $entityManagerInterface;

    public function __construct(Recipes $recipeRepository, EntityManagerInterface $entityManagerInterface){
        $this->recipeRepository = $recipeRepository;
        $this->entityManagerInterface = $entityManagerInterface; 
    }

    #[Route('/search', name: 'app_search')]
    public function index(): Response
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    #[Route('/search-meal/', name:'search_filter', methods:['GET'])]
    public function searchForMeal($userMealInput, Request $request){
        $form = $this->creatForm(SearchFormType::class, $userMealInput);
        $form->handleRequest($request);

        //implement search functionality
        $mealsFound = $this->recipeRepository->findAll();
    }
}
