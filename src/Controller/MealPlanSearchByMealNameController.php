<?php 

namespace App\Controller;

use App\Repository\MealsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MealPlanSearchByMealNameController extends AbstractController{

    private MealsRepository $mealsRepo;

    public function __construct(MealsRepository $mealsRepository){
        $this->mealsRepo = $mealsRepository;
    }

    #[Route('/all-meals/name/{mealName}', name:'search_by_meal_name', methods:['GET'])]
    public function searchByMealName(Request $request):Response{
        $mealName = $request->attributes->get('mealName');
        $response = $this->mealsRepo->searchByMealName($mealName);

        return $this->render('meals/meals-main-page.html.twig',[
            'meals' => $response
        ]);
    }
}
