<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChagePaswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
        ->add('speudo', TextType::class, [
            'disabled' => true,
            'label' => 'Ton speudo',
            'attr' => [
                'class' => 'InputChangePasword'
            ]
        ])
        ->add('old_password', PasswordType::class, [
                'label' => 'Ton mot de passe actuel',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Merci de saisir votre mot de passe actuel', 
                    'class' => 'InputChangePasword'
                ]
        ])
        ->add('new_password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques',
            'label' => 'Votre nouveau mot de passe',
            'mapped' => false,
            'required' => true,
            'first_options' => [
                'label' => 'Votre nouveau mot de passe',
                'constraints' => [
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'Votre speudo doit faire au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre speudo ne peut pas faire plus de {{ limit }} caractères',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Merci de saisir votre mot de passe',
                    'class' => 'InputChangePasword'
                ]
            ],
            'second_options' => [
                'label' => 'Confirmer votre mot de passe',
                'constraints' => [
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'Votre speudo doit faire au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre speudo ne peut pas faire plus de {{ limit }} caractères',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Merci de confirmer votre nouveau mot de passe',
                    'class' => 'InputChangePasword'
                ]
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Modifier le mot de passe',
            'attr' => [
                'class' => 'submitChangePasword'
            ]
        ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
