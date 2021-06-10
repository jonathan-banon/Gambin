<?php

namespace App\Form;

use App\Entity\Accessory;
use App\Entity\Image;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class AccessoryType extends AbstractType
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
            ->add('product', EntityType::class, [
                "class" => Product::class,
                "choice_label" => "name"
            ])
            ->add('images', EntityType::class, [
                'class' => Image::class,
                'choice_label' => 'url',
                'expanded' => false,
                'multiple' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'form' => Accessory::class,
        ]);
    }
}
