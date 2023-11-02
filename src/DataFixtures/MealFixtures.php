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
        //$chickenCaesarSalad->setRecipe("first step");
        $manager->persist($chickenCaesarSalad);

        $bbqChicWrap = new Meals();
        $bbqChicWrap->setMealName('Barbeque Chicken Wrap');
        $bbqChicWrap->setMealDescription('bbq desc');
        //$bbqChicWrap->setIngredients('romaine lettuce, chicken, wraps, bbq sauce');
        $bbqChicWrap->setMealRating(4);
        $bbqChicWrap->setMealPhoto('https://cdn.pixabay.com/photo/2022/08/27/13/59/kebab-chicken-sandwich-7414522_1280.jpg');
        $bbqChicWrap->setMealType('dinner');
        $manager->persist($bbqChicWrap);

        $tunaMelt = new Meals();
        $tunaMelt->setMealName('Tuna Melt');
        $tunaMelt->setMealDescription('sandwich');
        //$bbqChicWrap->setIngredients('romaine lettuce, chicken, wraps, bbq sauce');
        $tunaMelt->setMealRating(2);
        $tunaMelt->setMealPhoto('https://cdn.pixabay.com/photo/2016/08/09/11/24/sandwich-1580348_1280.jpg');
        $tunaMelt->setMealType('lunch');
        $manager->persist($tunaMelt);

        $steak = new Meals();
        $steak->setMealName('Steak');
        $steak->setMealDescription('steak');
        //$bbqChicWrap->setIngredients('romaine lettuce, chicken, wraps, bbq sauce');
        $steak->setMealRating(5);
        $steak->setMealPhoto('https://cdn.pixabay.com/photo/2016/01/22/02/13/meat-1155132_1280.jpg');
        $steak->setMealType('dinner');
        $manager->persist($steak);

        $parfait = new Meals();
        $parfait->setMealName('Parfait');
        $parfait->setMealDescription('parfait');
        //$bbqChicWrap->setIngredients('romaine lettuce, chicken, wraps, bbq sauce');
        $parfait->setMealRating(1);
        $parfait->setMealPhoto('https://cdn.pixabay.com/photo/2016/11/23/15/31/berry-1853547_1280.jpg');
        $parfait->setMealType('breakfast');
        $manager->persist($parfait);

        $pancakes = new Meals();
        $pancakes->setMealName('Pancakes');
        $pancakes->setMealDescription('pancakes');
        //$bbqChicWrap->setIngredients('romaine lettuce, chicken, wraps, bbq sauce');
        $pancakes->setMealRating(1);
        $pancakes->setMealPhoto('https://cdn.pixabay.com/photo/2017/05/07/08/56/pancakes-2291908_1280.jpg');
        $pancakes->setMealType('breakfast');
        $manager->persist($pancakes);

        $burger = new Meals();
        $burger->setMealName('Burger');
        $burger->setMealDescription('burger');
        //$bbqChicWrap->setIngredients('romaine lettuce, chicken, wraps, bbq sauce');
        $burger->setMealRating(1);
        $burger->setMealPhoto('https://cdn.pixabay.com/photo/2016/03/05/19/02/hamburger-1238246_1280.jpg');
        $burger->setMealType('lunch');
        $manager->persist($burger);

        $manager->flush();
    }
}


