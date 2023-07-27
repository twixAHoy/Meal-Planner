<?php

namespace App\Entity;

use App\Repository\ShoppingListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShoppingListRepository::class)]
class ShoppingList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 10)]
    private ?string $typeOfIngredient = null;

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

    public function getTypeOfIngredient(): ?string
    {
        return $this->typeOfIngredient;
    }

    public function setTypeOfIngredient(string $typeOfIngredient): self
    {
        $this->typeOfIngredient = $typeOfIngredient;

        return $this;
    }
}
