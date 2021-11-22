<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Prénom'
            ]
        ])
        ->add('lastname', TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Nom de famille'
            ]
        ])
        ->add('email', EmailType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'E-mail'
            ]
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options' => ['label' => false,
                                'attr' => [
                                    'placeholder' => 'Mot de passe - 6 caractères minimum'
                                ],
                                'constraints' => new Length(['min' => 6,
                                                             'minMessage' => 'Votre mot de passe doit contenir au minimum 6 caractères',
                                                             'max' =>255
                                ])
            ],
            'second_options' => ['label' => false,
                                 'attr' => [
                                     'placeholder' => 'Confirmation mot de passe'
                                 ]
            ],
            'invalid_message' => 'Mots de passe différents'
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Inscription'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
