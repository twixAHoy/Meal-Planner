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

    #[ORM\ManyToOne(targetEntity:"App\Entity\Meals")]
    #[ORM\JoinColumn(name:"meal_id", referencedColumnName:"id")]
    private ?Meals $meal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeal(): ?Meals
    {
        return $this->meal;
    }

    /*public function setMeal(Meals $meal): self
    {
        $this->meal = $meal;

        return $this;
    }*/
}
