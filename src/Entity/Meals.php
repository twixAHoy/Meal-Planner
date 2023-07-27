<?php

namespace App\Entity;

use App\Repository\MealsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MealsRepository::class)]
class Meals
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 100)]
    public ?string $meal_Name = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $meal_Description = null;

    #[ORM\Column(nullable: true)]
    public ?int $meal_Rating = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $meal_Photo = null;

    #[ORM\Column(length: 10)]
    private ?string $mealType = null;

    // #[ORM\OneToMany(mappedBy: 'meal',targetEntity: "App\Entity\Recipes")]
    // private ?string $recipe;

    public function __construct(){
    
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMealName(): ?string
    {
        return $this->meal_Name;
    }

    public function setMealName(string $meal_Name): self
    {
        $this->meal_Name = $meal_Name;

        return $this;
    }

    public function getMealDescription(): ?string
    {
        return $this->meal_Description;
    }

    public function setMealDescription(?string $meal_Description): self
    {
        $this->meal_Description = $meal_Description;

        return $this;
    }

    public function getMealRating(): ?int
    {
        return $this->meal_Rating;
    }

    public function setMealRating(?int $meal_Rating): self
    {
        $this->meal_Rating = $meal_Rating;

        return $this;
    }

    public function getMealPhoto(): ?string
    {
        return $this->meal_Photo;
    }

    public function setMealPhoto(?string $meal_Photo): self
    {
        $this->meal_Photo = $meal_Photo;

        return $this;
    }

    public function getMealType(): ?string
    {
        return $this->mealType;
    }

    public function setMealType(string $mealType): self
    {
        $this->mealType = $mealType;

        return $this;
    }

    // /**
    //  * @return string|Recipe[]
    //  */
    // public function getRecipe(): string
    // {
    //     return $this->recipe;
    // }

    // public function setRecipe(string $recipe): self
    // {
    //    $this->recipe = $recipe;
    //    return $this;
    // }

}
