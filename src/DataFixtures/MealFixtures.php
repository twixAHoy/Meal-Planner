<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Meals;

class MealFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
    
        $chickenCaesarSalad = new Meals();
        $chickenCaesarSalad->setMealName('Caesar Chicken Salad');
        $chickenCaesarSalad->setMealDescription('salad desc');
        //$chickenCaesarSalad->SET('romaine lettuce, caesar dressing, croutons, chicken');
        $chickenCaesarSalad->setMealRating(5);
        $chickenCaesarSalad->setMealPhoto('https://cdn.pixabay.com/photo/2017/08/11/00/32/salad-2629262_1280.jpg');
        $chickenCaesarSalad->setMealType('lunch');
        $manager->persist($chickenCaesarSalad);

        $bbqChicWrap = new Meals();
        $bbqChicWrap->setMealName('Barbeque Chicken Wrap');
        $bbqChicWrap->setMealDescription('bbq desc');
        //$bbqChicWrap->setIngredients('romaine lettuce, chicken, wraps, bbq sauce');
        $bbqChicWrap->setMealRating(4);
        $bbqChicWrap->setMealPhoto('https://cdn.pixabay.com/photo/2022/08/27/13/59/kebab-chicken-sandwich-7414522_1280.jpg');
        $bbqChicWrap->setMealType('dinner');
        $manager->persist($bbqChicWrap);

        $manager->flush();
    }
}


