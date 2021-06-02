<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => ['placeholder'      => 'Email',
                           'aria-describedby' => "basic-addon1",
                           'class'            => 'picture-input',
                           ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label'  => "J'accepte les conditions générales",
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez acceptez nos conditions générales pour vous inscrire.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder'  => 'Mot de passe',
                    'aria-describedby' => "basic-addon4",
                    'class' => 'picture-input',
                     ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('firstName', TextType::class, [
                'attr' => ['aria-describedby' => "basic-addon2",
                            'placeholder' => 'Prénom',
                            'class' => 'picture-input',
                            ],
            ])
            ->add('lastName', TextType::class, [
                'attr' => ['aria-describedby' => "basic-addon3",
                           'placeholder' => 'Nom',
                           'class' => 'picture-input'
                ],
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
