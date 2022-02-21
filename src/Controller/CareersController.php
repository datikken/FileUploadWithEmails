<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CareersController extends AbstractController
{
    /**
     * @Route("/careers", name="careers")
     */
    public function index(): Response
    {
        return $this->render('careers/index.html.twig', [
            'controller_name' => 'CareersController',
        ]);
    }
}
