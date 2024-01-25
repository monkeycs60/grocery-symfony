<?php 
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct(private MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail($to = 'clement.serizay@gmail.com', $content = '
    <p>See Twig integration for better HTML integration!</p>
    '): void
    {
        $email = (new Email())
            ->from('clement.serizay@gmail.com')
            ->to($to)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Confirmation de votre commande Culinaria !')
            ->html($content);

        $this->mailer->send($email);

        // ...
    }
}