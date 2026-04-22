<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FrontController extends AbstractController
{
    #[Route('/{vueRouting}', name: 'app_index', requirements: ['vueRouting' => '^(?!api|_wdt|_profiler).*$'], defaults: ['vueRouting' => null])]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}
