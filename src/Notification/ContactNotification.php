<?php

namespace App\Notification;

use App\Entity\Contact;
use App\Entity\User;
use Twig\Environment;

class ContactNotification
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(Environment $renderer, \Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }
    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message('Nouveau message de  ' . $contact->getEmail()))
            ->setFrom($contact->getEmail())
            ->setTo('ecommerce@gmail.com')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact.html.twig', [
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($message);
    }

    public function registerNotify(User $user)
    {
        $message = (new \Swift_Message('Nouveau message de ' . $user->getEmail())) // sujet du mail
            ->setFrom($user->getEmail()) // adresse mail de l'expéditeur
            ->setTo('samuel.evgform@gmail.com') // adresse mail du destinataire
            ->setReplyTo($user->getEmail()) // adresse mail de réponse
            ->setBody($this->renderer->render('emails/register.html.twig', [
                'user' => $user
            ]), 'text/html'); // contenu du mail, corps du message déclaré dans le template emails/register.html.twig
        $this->mailer->send($message);
    }
}
