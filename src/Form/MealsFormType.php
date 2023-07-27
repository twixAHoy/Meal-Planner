<?php

namespace App\Form;

use App\Entity\Meals;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MealsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('meal_Name', TextType::class,[
                'label' => 'Enter Meal Name',
                'attr' => array (
                    'class' => 'meal-name-form',
                    'placeholder' => 'Enter Meal Name...'
                ),
            ])   
            ->add('meal_Description', TextType::class,[
                'attr' => array (
                    'class' => 'meal-name-form'
                ),
            ])
            /*->add('meal_Rating', null,[
                'attr' => array (
                    'class' => 'meal-rating-form'
                )
            ])*/
            ->add('meal_Photo', FileType::class,[
                'attr' => array (
                    'class' => 'meal-photo-form'
                ),
            ])
            ->add('recipeSteps')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Meals::class,
        ]);
    }
}
