<?php

namespace App\Controller;

use App\Repository\MealsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MealPlanShowAllMealsController extends AbstractController{

    private MealsRepository $mealsRepo;

    public function __construct(MealsRepository $mealsRepository)
    {
        $this->mealsRepo = $mealsRepository;
    }

    #[Route('/all-meals', name: 'show_meals')]
    public function showAllMeals(): Response{

        //$form = $this->searchController->showFormInMealsPage();
        $meals = $this->mealsRepo->showAllMeals();

        return $this->render('meals/meals-main-page.html.twig', [
            'meals' => $meals
            //'form' => $form
        ]);
    }

    #[Route('/filtered-meals', name: 'show_meals_by_meal_type')]
    public function showAllMealsByMealType(array $filteredMeals): Response{

        //$form = $this->searchController->showFormInMealsPage();
        //$meals = $this->mealsRepo->showAllMeals();

        return $this->render('meals/meals-main-page.html.twig', [
            'meals' => $filteredMeals
            //'form' => $form
        ]);
    }
}