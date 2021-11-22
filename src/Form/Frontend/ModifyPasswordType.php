<?php

namespace App\Form\Frontend;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ModifyPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('current_password', PasswordType::class, [
                'label' => false,
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'first_options' => ['label' => false,
                                    'attr' => [
                                        'placeholder' => 'Nouveau mot de passe - 6 caractères minimum'
                                    ],
                                    'constraints' => new Length(['min' => 6,
                                                                 'minMessage' => 'Votre nouveau mot de passe doit contenir au minimum 6 caractères',
                                                                 'max' =>255
                                    ])
                ],
                'second_options' => ['label' => false,
                                     'attr' => [
                                         'placeholder' => 'Confirmation nouveau mot de passe'
                                     ]
                ],
                'invalid_message' => 'Mots de passe différents'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Modifier mot de passe'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
