<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MealsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MealPlanSearchByMealTypeController extends AbstractController{

    private MealsRepository $mealsRepo;
    private MealPlanShowAllMealsController $mealPlanShowAllMeals;

    public function __construct(MealsRepository $mealsRepo, MealPlanShowAllMealsController $mealPlanShowAllMealsController){
        $this->mealsRepo = $mealsRepo;
        $this->mealPlanShowAllMeals = $mealPlanShowAllMealsController;
    }

    #[Route('/all-meals/meal-type/{mealType}', name: 'search_by_meal_type', methods:[GET])]
    public function searchByMealType(Request $request){
        $mealType = $request->attributes->get('mealType');
        $response = $this->mealsRepo->showMealsByMealType($mealType);

        return $this->mealPlanShowAllMeals->showAllMealsByMealType($response);
    }
}