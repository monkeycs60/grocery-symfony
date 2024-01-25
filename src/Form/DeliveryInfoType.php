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
        ])
            ->add('orderInfo', EntityType::class, [
                'class' => Order::class,
                // Enlève les commandes déjà validées pour l'utilisateur connecté
                  'query_builder' => function (OrderRepository $er) use ($options) {
                return $er->createQueryBuilder('o')
            ->where('o.status != :status')
            ->andWhere('o.user = :user') 
            ->setParameters([
                'status' => 'Validé',
                'user' => $options['user'] 
            ]);
            },
'choice_label' => 'id',
'label' => 'Commande n° (utile si vous avez plusieurs commandes en attente de validation)',
            ])    
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
