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

    #[Route('/recipes', name: 'show_recipes')]
    public function showAllRecipes(Request $request): Response
    {
        $form = $this->searchController->showFormInMealsPage();
       // $form->handleRequest($request);

        $recipes = $this->recipeRepository->findAll();
        return $this->render('recipes/recipes.html.twig', [
            'recipes' => $recipes,
            'form' => $form
        ]);
    }


    #[Route('/recipes/add', name: 'add_recipes')]
    public function addNewRecipe(Request $request): Response
    {
        $recipe = new Recipes();

        $form = $this->createForm(AddRecipeFormType::class, $recipe);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $newRecipe = $form->getData();
            $imagePath = $form->get('image')->getData();

            if($imagePath){
                $newFileName = uniqid() . '.' . $imagePath->guessExtension();
                try{
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads', $newFileName
                    );
                }catch(FileException $e){
                    return new Response($e->getMessage());
                }
                $newRecipe->setImage('/uploads/' . $newFileName);
            }

            try{
                //persist data
                $this->em->persist($newRecipe);
                $this->em->flush();

                //reroute to recipes
                return $this->redirectToRoute('show_recipes');
            }catch(Exception $e){
                return new Response($e->getMessage());
            }
        }
        //reroute to recipes
        return $this->render('recipes/add.html.twig',[
            'form' => $form
        ]);
    }

    #[Route('/recipes/edit/{id}', name: 'edit_recipe', methods:['GET', 'POST'])]
    public function editRecipe(Request $request, $id):Response
    {
        $recipe = $this->recipeRepository->find($id);
        $form = $this->createForm(EditRecipeFormType::class, $recipe);
        
        $form->handleRequest($request);

        //TODO: fix handling of images
        $imagePath = $form->get('image')->getData();

        if($form->isSubmitted() && $form->isValid()){
            //image update
            if($imagePath){
                if($recipe->getImage() !== null){
                    if(file_exists($this->getParameter('kernel.project_dir') . $recipe->getImage())){
                        $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                        try{
                            $imagePath->move($this->getParameter('kernel.project_dir') . '/public/uploads', $newFileName);
                        }catch(FileException $e){
                            return new Response($e->getMessage());
                        }
                        $recipe->setImage('/uploads/' . $newFileName);
                        $this->em->flush();
                    }
                }
            }
                $recipe->setName($form->get('name')->getData());
                $recipe->setDescription($form->get('description')->getData());
                $recipe->setIngredients($form->get('ingredients')->getData());

                $this->em->flush();
                return $this->redirectToRoute('show_recipes');
        }

        return $this->render('recipes/edit.html.twig',[
            'recipe' => $recipe,
            'form' => $form->createView()
        ]);
    }

    #[Route('/recipes/delete/{id}', name:'delete_recipe')]
    public function deleteRecipe($id): Response{
        $recipe = $this->recipeRepository->find($id);
        $this->em->remove($recipe);
        $this->em->flush();

        return $this->redirectToRoute('show_recipes');
    }


}
