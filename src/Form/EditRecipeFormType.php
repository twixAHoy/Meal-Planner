<?php

namespace App\Form;

use App\Entity\Recipes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EditRecipeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class,[
            'attr' =>array(
                'class' => 'recipe-name-text-box-edit',
                'placeholder' => 'Enter Title...'
            ),
            'label' => false,
            'required' => false
        ])
        ->add('description', TextareaType::class,[
            'attr' =>array(
                'class' => 'recipe-text-area-box-edit',
                'placeholder' => 'Enter Description...'
            ),
            'label' => false
        ])
        ->add('ingredients', TextareaType::class,[
            'attr' =>array(
                'class' => 'recipe-text-area-box-edit',
                'placeholder' => 'Enter Description...'
            ),
            'label' => false
        ])
           // ->add('image')
        ->add('rating', IntegerType::class,[
            'attr'=> array(
            'class' => 'rating-edit',
            'placeholder' => 'Enter a rating between 1 and 5'
            ),
        'label' => false
        ])
        ->add('image', FileType::class, array(
            'required' => false,
            'mapped' => false //don't associate class with entity properties
        ));

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipes::class,
        ]);
    }
}
