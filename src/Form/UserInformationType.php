<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label'     => 'Prénom',
                'required'  => false,
            ])
            ->add('lastName', TextType::class, [
                'label'     => 'Nom',
                'required'  => false,
            ])
            ->add('pseudo', TextType::class, [
                'label'     => 'Pseudo',
            ])
            ->add('birthDate', BirthdayType::class, [
                'widget'    => 'single_text',
                'label'     => 'Date de naissance',
                'required'  => false,
            ])
            ->add('email', TextType::class, [
                'label' => 'E-mail',
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Numéro de Téléphone',
                'required'  => false,
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'required'  => false,
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Code Postal',
                'required'  => false,
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
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
