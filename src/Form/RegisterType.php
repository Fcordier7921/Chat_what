<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('speudo', TextType::class, [
                'label' => 'Votre speudo!',
                'constraints' => [
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'Votre speudo doit faire au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre speudo ne peut pas faire plus de {{ limit }} caractères',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Merci de saisir votre speudo',
                    'class' => 'formRegisterSpeudo'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre Email',
                'attr' => [
                    'placeholder' => 'Emerci de saisir votre adresse email',
                    'class' => 'formRegisterEmail'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques',
                'label' => 'Votre mot de passe',
                'required' => true,
                'first_options' => [
                    'label' => 'Votre mot de passe',
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
                        'class' => 'formRegisterPassword'
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
                        'placeholder' => 'Merci de confirmer votre mot de passe',
                        'class' => 'formRegisterPassword'
                    ]
                ]
            ])
            
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'formRegisterSubmit'
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
