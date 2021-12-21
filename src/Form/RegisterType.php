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
            'label' => 'PRÉNOM'
        ])
        ->add('lastname', TextType::class, [
            'label' => 'NOM DE FAMILLE'
        ])
        ->add('email', EmailType::class, [
            'label' => 'E-MAIL'
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options' => ['label' => 'MOT DE PASSE',
                                'attr' => [
                                    'placeholder' => '6 caractères minimum'
                                ],
                                'constraints' => new Length(['min' => 6,
                                                             'minMessage' => 'Votre mot de passe doit contenir au minimum 6 caractères',
                                                             'max' =>255
                                ])
            ],
            'second_options' => ['label' => 'RÉPÉTEZ LE MOT DE PASSE',
                                 'attr' => [
                                     'placeholder' => '6 caractères minimum'
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
