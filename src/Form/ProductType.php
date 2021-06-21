<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Accessory;
use App\Entity\Marque;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('characteristic')
            ->add('argumentOne')
            ->add('argumentTwo')
            ->add('argumentThree')
            ->add('pricePerDay')
            ->add('priceService')
            ->add('images', EntityType::class, [
                'class' => Image::class,
                'choice_label' => 'url',
                'expanded' => false,
                'multiple' => true,
                'by_reference' => false,
            ])
            ->add('accessories', EntityType::class, [
                'by_reference' => false,
                'class' => Accessory::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ])
            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
