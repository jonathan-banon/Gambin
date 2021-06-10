<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'required'  => false,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'required'  => false,
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Numéro de téléphone',
                'required'  => false,
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse du domicile',
                'required'  => false,
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Code postal',
                'required'  => false,
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'required'  => false,
            ])
            ->add('billingAddress', TextType::class, [
                'label' => 'Adresse de facturation',
                'required'  => false,
            ])
            ->add('billingPostal', TextType::class, [
                'label' => 'Code postal (adresse facturation)',
                'required'  => false,
            ])
            ->add('billingCity', TextType::class, [
                'label' => 'Ville (adresse facturation)',
                'required'  => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
