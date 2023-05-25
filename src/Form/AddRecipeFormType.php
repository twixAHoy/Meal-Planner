<?php

namespace App\Form;

use App\Entity\Recipes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AddRecipeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'attr' => array(
                    'class' => 'form-control p-5',
                    'placeholder' => 'Enter meal name..'
                ),
                'label' => false,
                'required' => false
            ])
            ->add('description', TextareaType::class,[
                'attr' => array(
                    'class' => 'form-control mt-10 p-4',
                    'placeholder' => 'Enter description..',
                    'rows' => 3
                ),
                'label' => false,
                'required' => false
            ])
            ->add('ingredients', TextareaType::class,[
                'attr' => array(
                    'class' => 'form-control mt-10 p-4',
                    'placeholder' => 'Enter ingredients..',
                    'rows' => 3
                ),
                'label' => false,
                'required' => false
            ])
            ->add('image', FileType::class, [
                'attr'=>array(
                    'class' =>'rounded-xl w-full shadow-xl'
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipes::class,
        ]);
    }
}
