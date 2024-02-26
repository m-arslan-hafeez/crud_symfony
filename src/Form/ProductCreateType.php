<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, array(
                'label'=> 'Product name',
                'empty_data'=>'',
                'required' => true,
                'attr' => array(
                    'class'=> 'form-control form-control-sm rounded-0'
                )))

            ->add('description', TextType::class, array(
                'label'=> 'Product description',
                'empty_data'=>'',
                'required' => true,
                'attr' => array(
                    'class'=> 'form-control form-control-sm rounded-0'
                )))

            ->add('price', IntegerType::class, array(
                'label'=> 'Product price',
                'empty_data'=>'',
                'required' => true,
                'attr' => array(
                    'class'=> 'form-control form-control-sm rounded-0'
                )))

            ->add('submit', SubmitType::class, array(
                'label' => 'Submit',
                'attr' => array(
                    'class' =>  "btn btn-sm btn-primary pull-right btn-flat"
                ),

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class
        ]);
    }
}
