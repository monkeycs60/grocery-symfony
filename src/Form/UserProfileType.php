<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class,
        [
            'constraints' => [
                new NotBlank([
                    'message' => "Merci d'entrer un nom d'utilisateur",
                ]),
                new Length([
                    'min' => 3,
                    'minMessage' => 'Votre nom d\'utilisateur doit contenir au moins {{ limit }} caractères',
                    // max length allowed by Symfony for security reasons
                    'max' => 255,
                ]),
            ],
        ]
        )
        ->add('plainPassword', PasswordType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => "Mot de passe",
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ->add('address', TextType::class,
        [
            'label' => 'Adresse',
            'constraints' => [
                new NotBlank([
                    'message' => "Merci d'entrer une adresse",
                ]),
                new Length([
                    'min' => 3,
                    'minMessage' => 'Votre adresse doit contenir au moins {{ limit }} caractères',
                    // max length allowed by Symfony for security reasons
                    'max' => 255,
                ]),
            ],
        ]
        )
        ->add('deliveryPreference', ChoiceType::class, [
            'choices' => [
                'En magasin' => 'en magasin',
                'Livraison à domicile' => 'livraison à domicile',
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
