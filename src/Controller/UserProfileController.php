<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request, User $user, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
    // Verifie la connexion de l'utilisateur 
    /** @var User $user */
    $user = $this->getUser();
    // handle form
    $form = $this->createForm(UserProfileType::class, $user);
    $form->handleRequest($request);

     if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('username')->getData() !== null) {
        $user->setUsername($form->get('username')->getData());
    }
        
        if ($form->get('address')->getData() !== null) {
        $user->setAddress($form->get('address')->getData());
    }

        if ($form->get('deliveryPreference')->getData() !== null) {
        $user->setDeliveryPreference($form->get('deliveryPreference')->getData());
    }


        // Vérifiez si le champ de mot de passe a été rempli
         $plainPassword = $form->get('plainPassword')->getData();
    if (!empty($plainPassword)) {
        $user->setPassword(
            $passwordHasher->hashPassword($user, $plainPassword)
        );
    }

        // Les autres champs sont gérés normalement
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Profil mis à jour avec succès!');

        return $this->redirectToRoute('app_profile');

    }
      return $this->render('user_profile/index.html.twig', [
        'profileForm' => $form->createView(),
    ]);
}
}
