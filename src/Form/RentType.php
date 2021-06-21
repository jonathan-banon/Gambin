<?php

namespace App\Form;

use App\Entity\Deposit;
use App\Entity\Item;
use App\Entity\Rent;
use App\Entity\Status;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class RentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateIn', null, [
                'label' => 'Date de début',
            ])
            ->add('dateOut', null, [
                'label' => 'Date de retour'
            ])
            ->add('deposit', EntityType::class, [
                'class' => Deposit::class,
                'label' => 'Lieu de dépôt',
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rent::class,
        ]);
    }
}
