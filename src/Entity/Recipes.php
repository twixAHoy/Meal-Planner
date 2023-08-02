<?php

namespace App\Entity;

use App\Repository\RecipesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipesRepository::class)]
class Recipes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable:true)]
    private ?int $mealID = null;

    #[ORM\Column(length: 250)]
    public ?string $recipeSteps = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMealID(){
        return $this->mealID;
    }

    public function setMealID(?int $mealID){
        $this->mealID = $mealID;
    }
    
    public function getRecipeSteps(): ?string
    {
        return $this->recipeSteps;
    }

    public function setRecipeStep(string $recipeStep)
    {
        $this->meal = $meal;
    }
}

