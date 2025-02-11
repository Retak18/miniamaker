<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LandingPageController extends AbstractController{
    #[Route('/landing/add', name: 'lp_add')]
    public function index(): Response
    {
        $user = $this->getUser();
        if(
            (!$user !== "ROLE_PRO" && !$user !== "ROLE_AGENT"))
            
        {
            return $this->redirectToRoute('app_detail');
        }
        return $this->render('landing_page/index.html.twig', [
            'controller_name' => 'LandingPageController',
        ]);
    }
}
