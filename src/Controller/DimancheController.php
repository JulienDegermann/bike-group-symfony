<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DimancheController extends AbstractController
{
    #[Route('/dimanche', name: 'app_dimanche')]
    public function index(): Response
    {
        return $this->render('dimanche/dimanche.html.twig', [
            'controller_name' => 'DimancheController',
        ]);
    }
}
