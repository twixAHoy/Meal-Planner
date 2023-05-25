<?php

namespace App\DataFixtures;

use App\Entity\Recipes;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RecipesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $chickenCaesarSalad = new Recipes();
        $chickenCaesarSalad->setName('Caesar Chicken Salad');
        $chickenCaesarSalad->setDescription('salad desc');
        $chickenCaesarSalad->setIngredients('romaine lettuce, caesar dressing, croutons, chicken');
        $chickenCaesarSalad->setRating(5);
        $chickenCaesarSalad->setImage('https://cdn.pixabay.com/photo/2017/08/11/00/32/salad-2629262_1280.jpg');
        $manager->persist($chickenCaesarSalad);

        $bbqChicWrap = new Recipes();
        $bbqChicWrap->setName('Barbeque Chicken Wrap');
        $bbqChicWrap->setDescription('bbq desc');
        $bbqChicWrap->setIngredients('romaine lettuce, chicken, wraps, bbq sauce');
        $bbqChicWrap->setRating(4);
        $bbqChicWrap->setiMAGE('https://cdn.pixabay.com/photo/2022/08/27/13/59/kebab-chicken-sandwich-7414522_1280.jpg');
        $manager->persist($bbqChicWrap);

        $manager->flush();
    }
}
