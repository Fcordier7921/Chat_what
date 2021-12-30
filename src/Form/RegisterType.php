<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
                'label' => 'Votre speudo',
                'constraints' => [
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'Votre speudo doit faire au moins {{ limit }} caractères',
                        'maxMessage' => 'Votre speudo ne peut pas faire plus de {{ limit }} caractères',
                    ]),
                ],
                'attr' => [
                    'placeholder' => ' Merci de saisir votre speudo',
                    'class' => 'inputRegister'
                ]
            ])
            ->add('Nom', TextType::class, [
                'label' => 'Votre Nom',
                'attr' => [
                    'placeholder' => ' Merci de saisir votre Nom',
                    'class' => 'inputRegister'
                ]
            ])
            ->add('Prenom', TextType::class, [
                'label' => 'Votre Prénom',
                'attr' => [
                    'placeholder' => ' Merci de saisir votre Prénom',
                    'class' => 'inputRegister'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre Email',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre adresse email',
                    'class' => 'inputRegister'
                ]
            ])
            ->add('adress', TextType::class, [
                'label' => 'Votre Adresse postal',
                'label_attr' => [
                    'class' => 'required'
                ],
                'attr' => [
                    'placeholder' => ' Merci de saisir votre Adresse postal',
                    'class' => 'inputRegister'
                ],
                'required' => false
            ])
            ->add('telephone', NumberType::class, [
                'label' => 'Votre numéro de téléphone',
                'label_attr' => [
                    'class' => 'required'
                ],
                'attr' => [
                    'placeholder' => ' Merci de saisir votre numéro de téléphone',
                    'class' => 'inputRegister'
                ],
                'required' => false
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
                        'class' => 'inputRegister'
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
                        'class' => 'inputRegister'
                    ]
                ]
            ])
            
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'submitRegister'
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
