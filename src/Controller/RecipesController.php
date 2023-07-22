<?php

namespace App\Controller;

use App\Entity\Recipes;
use App\Form\AddRecipeFormType;
use App\Form\EditRecipeFormType;
use App\Repository\RecipesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class RecipesController extends AbstractController
{
    private $recipeRepository;
    private $em;
    private $searchController;

    public function __construct(RecipesRepository $recipesRepository, EntityManagerInterface $em, SearchController $searchController){
        $this->recipeRepository = $recipesRepository;
        $this->em = $em;
        $this->searchController = $searchController;
    }
}
