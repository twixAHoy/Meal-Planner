<?php

namespace App\Entity;

use App\Repository\RecipesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipesRepository::class)]
class Recipes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ingredients = null;

    #[ORM\Column(nullable: true)]
    private ?int $rating = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $recipeSteps = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isLunch = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDinner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(?string $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getRecipes(): ?Lunch
    {
        return $this->recipes;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getRecipeSteps(): ?string
    {
        return $this->recipeSteps;
    }

    public function setRecipeSteps(?string $recipeSteps): self
    {
        $this->recipeSteps = $recipeSteps;

        return $this;
    }

    public function isIsLunch(): ?bool
    {
        return $this->isLunch;
    }

    public function setIsLunch(?bool $isLunch): self
    {
        $this->isLunch = $isLunch;

        return $this;
    }

    public function isIsDinner(): ?bool
    {
        return $this->isDinner;
    }

    public function setIsDinner(?bool $isDinner): self
    {
        $this->isDinner = $isDinner;

        return $this;
    }
}
