<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MealsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MealPlanSearchByMealTypeController extends AbstractController{

    private MealsRepository $mealsRepo;

    public function __construct(MealsRepository $mealsRepo, MealPlanShowAllMealsController $mealPlanShowAllMealsController){
        $this->mealsRepo = $mealsRepo;
        $this->mealPlanShowAllMeals = $mealPlanShowAllMealsController;
    }

    #[Route('/all-meals/type/{mealType}', name: 'search_by_meal_type', methods:['GET'])]
    public function searchByMealType(Request $request):Response{
        $mealType = $request->attributes->get('mealType');
        $response = $this->mealsRepo->showMealsByMealType($mealType);
        return $this->render('meals/meals-main-page.html.twig', [
            'meals' => $response
        ]);
    }
}