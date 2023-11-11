<?php

namespace App\Controller;

use App\Entity\Meals;
use App\Form\MealsFormType;
use App\Repository\MealsRepository;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MealPlanAddMealController extends AbstractController
{
    private $mealsRepo;

    public function __construct(MealsRepository $mealsRepo){
        $this->mealsRepo = $mealsRepo;
    }

    #[Route('/add/meal', name: 'add_meal')]
    public function addAMeal(Request $request): Response{
        $meal = new Meals();
        $form = $this->createForm(MealsFormType::class, $meal);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            var_dump($form->getData()); die();
            try{
                $newMeal = $form->getData();
                $imagePath = $form->get('meal_Photo')->getData();
                if($imagePath){
                    $newFileName = uniqid() . '.' . $imagePath->guessExtension();
                    try{
                        $imagePath->move(
                            $this->getParameter('kernel.project_dir') . '/public/uploads',$newFileName);
                    }catch(FileException $e){
                        return new Response($e->getMessage());
                    }
                    $meal->setMealPhoto('/uploads/' . $newFileName);
                }
                $this->mealsRepo->addNewMeal($newMeal);
                return $this->redirectToRoute('show_meals');
            }catch(RuntimeException $e){
                return $e->getMessage();
            }
        }
        return $this->render('meals/meals-modify.html.twig',[
            'form' => $form
        ]);
    }
    
    
    
    
    
    #[Route('/meals', name: 'app_meals')]
    public function index(): Response
    {
        return $this->render('meals/index.html.twig', [
            'controller_name' => 'MealsController',
        ]);
    }
}
