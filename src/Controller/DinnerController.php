<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DinnerController extends AbstractController
{
    #[Route('/dinner', name: 'app_dinner')]
    public function index(): Response
    {
        return $this->render('dinner/index.html.twig', [
            'controller_name' => 'DinnerController',
        ]);
    }
}
