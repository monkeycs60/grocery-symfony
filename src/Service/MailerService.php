<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class MailerService
{
    private $mailer;
    private $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendEmail($to, $user, $deliveryInfo, $order)
    {
        $content = $this->twig->render('emails/order_confirmation.html.twig', [
            'user' => $user,
            'deliveryInfo' => $deliveryInfo,
            'order' => $order
        ]);

        $email = (new Email())
            ->from('clement.serizay@gmail.com')
            ->to($to)
            ->subject('Confirmation de votre commande Culinaria !')
            ->html($content);

        $this->mailer->send($email);
    }
}