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
            'required' => false,
            'label' => 'Nom d\'utilisateur',
            'constraints' => [
                new Length([
                    'min' => 3,
                    'minMessage' => 'Votre nom d\'utilisateur doit contenir au moins {{ limit }} caractères',
                    'max' => 255,
                ]),
            ],
        ]
        )
        ->add('plainPassword', PasswordType::class, [
                // Au lieu d'être encodé ici, le mot de passe est encodé dans le controller
                'required' => false,
                'label' => "Nouveau mot de passe",
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ])
        ->add('address', TextType::class,
        [
            'required' => false,
            'label' => 'Adresse',
            'constraints' => [
                new Length([
                    'min' => 3,
                    'minMessage' => 'Votre adresse doit contenir au moins {{ limit }} caractères',
                    'max' => 255,
                ]),
            ],
        ]
        )
        ->add('deliveryPreference', ChoiceType::class, [
            'required' => false,
            'label' => 'Préférence de livraison',
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
