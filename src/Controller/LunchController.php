<?php

namespace App\Controller;

use App\Repository\RecipesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LunchController extends AbstractController
{
    private $em;
    private $recipeRepository;

    public function __construct(RecipesRepository $recipeRepository, EntityManagerInterface $em){
        $this->recipeRepository = $recipeRepository;
        $this->em = $em;
    }

    #[Route('/lunch', name: 'app_lunch')]
    public function index(): Response
    {
        return $this->render('lunch/index.html.twig', [
            'controller_name' => 'LunchController',
        ]);
    }

    //set isLunch if checkbox is clicked
    #[Route('/lunch/isChecked/{id}', name: 'lunch_checkbox')]
    public function isChecked($id): Response
    {
        $recipe = $this->recipeRepository->find($id);
        
        //if checkbox is clicked, set isLunch to 0 where id = $id
        if(isset($_GET['lunch-checkbox'])){
           $recipe->setIsLunch(1); 
        }else{
            $recipe->setIsLunch(0);
        }

        $this->em->flush();

        //reroute to recipes page
        return $this->redirectToRoute('show_recipes');
    }
}
