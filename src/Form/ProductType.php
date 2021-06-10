<?php

namespace App\Form;

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
            ->add('identifier')
            ->add('storage')
            ->add('target')
            ->add('characteristic')
            ->add('argument_one')
            ->add('argument_two')
            ->add('argument_three')
            ->add('price_per_day')

            ->add('marque', EntityType::class, [
                'class' => Marque::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
