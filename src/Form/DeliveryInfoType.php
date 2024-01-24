<?php

namespace App\Form;

use App\Entity\DeliveryInfo;
use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeliveryInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('address', null, [
                 'required' => true,
                'label' => 'Adresse de livraison',
            ])
            ->add('deliveryName', null, [
                 'required' => true,
                'label' => 'Nom complet pour la livraison',
            ])
              ->add('deliveryMethod', ChoiceType::class, [
            'required' => true,
            'choices' => [
                'En magasin' => 'Récupérer en magasin',
                'Livraison à domicile' => 'Livraison à domicile',
            ],
            'label' => 'Mode de livraison',
            // 'preferred_choices' sera configuré dans le contrôleur.
        ])
            ->add('orderInfo', EntityType::class, [
                'class' => Order::class,
                // Enlève les commandes déjà validées
                  'query_builder' => function (OrderRepository $er) use ($options) {
                return $er->createQueryBuilder('o')
            ->where('o.status != :status')
            ->andWhere('o.user = :user') // Ajoutez cette ligne
            ->setParameters([
                'status' => 'Validé',
                'user' => $options['user'] // Utilisez l'utilisateur passé en option
            ]);
            },
'choice_label' => 'id',
'label' => 'Commande n° (utile si vous avez plusieurs commandes en attente de validation)',
            ])
             // Écouteur d'événements pour prédéfinir une valeur
    
        ;

        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DeliveryInfo::class,
             'user' => null, 
        ]);
    }
}
