<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
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
                'label_attr' => ['class' => 'grey-text'],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez acceptez nos conditions générales pour vous inscrire.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les champs de mot de passe doivent correspondrent',
                'mapped' => false,
                'options' => ['attr' => ['autocomplete' => 'new-password',
                                         'aria-describedby' => "basic-addon4",
                                         'class' => 'picture-input',
                                        ]],
                'required' => true,
                'first_options'  => ['attr' => ['placeholder' => 'Mot de passe']],
                'second_options' => ['attr' => ['placeholder' => 'Confirmer le mot de passe']],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez indiquer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractères',
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
