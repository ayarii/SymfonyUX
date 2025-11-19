<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MeetUpController extends AbstractController
{
    #[Route('/meet/up', name: 'app_meet_up')]
    public function index(): Response
    {
        return $this->render('meet_up/index.html.twig', [
            'controller_name' => 'MeetUpController',
        ]);
    }

    #[Route('/meetup', name: 'meet_up')]
    public function symfonyMeetUp()
    {
        return $this->render("meet_up/show.html.twig");
    }


    
}
