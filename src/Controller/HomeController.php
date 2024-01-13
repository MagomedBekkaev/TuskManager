<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ProjetRepository $projetRepository): Response
    {

        $projets = $projetRepository->findAll();

        return $this->render('home/index.html.twig', [
            'projets' => $projets,
        ]);
    }
}
