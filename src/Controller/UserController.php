<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class UserController extends AbstractController{
    #[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/complete', name: 'app_complete', methods: ['POST'])]
    public function complete(Request $request, EntityManagerInterface $em): Response
    {
        $data = $request->getPayload();
        // $username = $request->getPayload('username');
        // $fullname = $request->getPayload('fullname');
        if(!empty($data->get('username')) && !empty($data->get('fullname'))) {
           
            dd('test');
            //enregistrer les données dans la base de données
            $user = $this->getUser(); //ici on récupèr l'utilisateur actuel
            $user
                ->setUsername($data->get('username'))// on met à jour
                ->setFullname($data->get('fullname'));// on met à jour
            
            $em->persist($user); //on persist l'utilisateur
            $em->flush(); //on sauvegarde les modifications en base de données

        //redirection avec flash message
        $this->addFlash('success', 'Votre profil est maintenant complet.');
    } else {
        $this->addFlash('error', 'Veuillez remplir tous les champs.');
    }
        return $this->redirectToRoute('app_profile');
        
    }
}
