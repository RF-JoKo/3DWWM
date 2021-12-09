<?php

namespace App\Form\Frontend;

use App\DTO\CreditCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CreditCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom du titulaire de la carte'
                ],
                'required' => true
            ])
            ->add('number', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Numéro de carte'
                ],
                'required' => true
            ])
            ->add('expiryMonth', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Mois d\'expiration - MM'
                ],
                'required' => true
            ])
            ->add('expiryYear', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Année d\'expiration - YY'
                ],
                'required' => true
            ])
            ->add('cryptogram', NumberType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Cryptogramme de sécurité'
                ],
                'required' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Payer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreditCard::class
        ]);
    }
}
