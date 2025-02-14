<?php

namespace App\Service;

use Exception;
use App\Entity\User;
use App\Entity\LoginHistory;
use DeviceDetector\DeviceDetector;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;


/**
 * Classe de gestion de l'historique de connexion des utilisateurs
 */

class LoginHistoryService
{
    public function __construct(
        private EntityManagerInterface $em,
        private MailerInterface $mailer){}

    public function addHistory(User $user, string $userAgent, string $ip): void
    {
        $deviceDetector = new DeviceDetector($userAgent);
        $deviceDetector->parse();

        $loginHistory = new LoginHistory();
        $loginHistory
            ->setUser($user)
            ->setIpAddress($ip)
            ->setDevice($deviceDetector->getDeviceName())
            ->setOs($deviceDetector->getOs()['name'])
            ->setBrowser($deviceDetector->getClient()['name'])
            ;
        $this->em->persist($loginHistory);
    
        $this->em->flush();

    }
    public function sendLoginNotification(User $user): void
    {
           // Préparation du contexte (date, heure, IP, etc.)
           $context = [
            'username' => $user->getUsername(),
            'loginTime' => new \DateTime(),
            // Tu peux ajouter d'autres informations pertinentes
        ];

        // Création de l'email avec le template adapté
        $email = (new TemplatedEmail())
            ->from('admin@miniamaker.com')
            ->to($user->getEmail())
            ->subject('Nouvelle connexion à votre compte')
            ->htmlTemplate('components/emails/connection.html.twig')
            ->context($context);
    
            // dd($email);
        // Envoi de l'email
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            throw new \Exception('Une erreur est survenue lors de l\'envoi de l\'email de connexion : ' . $e->getMessage());
        }
    }
}