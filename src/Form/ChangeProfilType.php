<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangeProfilType extends AbstractType
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
        ->add('visible', CheckboxType::class, [
            'label' => 'Cacher ces informations personelle, seul votre pesudo sera visible', 
            'label_attr' => [
                'class' => 'Labelcheckboxrequired'
            ],
            'attr' => [
                'class' => 'checkboxrequired'
            ],
            'required' => false
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Modifier',
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
