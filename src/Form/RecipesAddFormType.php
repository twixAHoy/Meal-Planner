<?php

namespace App\Form;

use App\Entity\Recipes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RecipesAddFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mealID', HiddenType::class)
            ->add('recipeStepID', IntegerType::class, [
                'label' => false,
                'attr' => array(
                    'class' => 'recipe-step-id',
                    'name' => 'recipeStepID',
                    'type' => 'number',
                    'min' => 1,
                    'step' => 1,
                    'style' => 'width: 30px; 
                                border-style: none; 
                                border-bottom: 1px solid black;
                                bottom: 4px;
                                left: 5px;
                                position: relative;
                                font-family: "Oswald", sans-serif;
                                font-size: medium;'
                ),
                ])
            ->add('recipeSteps', TextType::class, [
                'label' => false,
                'attr' => array (
                    'class' => 'recipe-step',
                    'name' => 'recipeSteps',
                    'placeholder' => 'Ex: Add 4 cups of water to the pot and bring to a boil',
                    'style' => 'border-style: none;
                                border-bottom: 1px solid grey;
                                margin-left: 57px;
                                bottom: 30px;
                                width: 300px;
                                position: relative;
                                font-family: "Oswald", sans-serif;
                                font-size: medium;'
                ),
            ])            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipes::class,
            'attr' => ['id' => 'add-new-recipe-form-id']
        ]);
    }
}
