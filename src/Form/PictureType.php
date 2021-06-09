<?php

namespace App\Form;

use _HumbugBoxa991b62ce91e\Nette\PhpGenerator\Type;
use App\Entity\Image;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('url', EntityType::class, [
                "class" => Image::class,
                "choice_label" => "url"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'formPictures' => Image::class,
        ]);
    }
}
