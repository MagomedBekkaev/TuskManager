<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Repository\UserRepository;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ProjetRepository $projetRepository): Response
    {
        $user = $this->getUser(); // Get the logged-in user
        $projets = $projetRepository->findByUser($user); // Fetch projects for the user

        return $this->render('home/home.html.twig', [
            'projets' => $projets,
        ]);
    }


    #[Route('/home/new', name: 'new_projet', methods: ['POST'])]
    public function newProjet(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $user = $this->getUser(); // Get the current logged in user
        $projet = new Projet();
        $projet->setUser($user);

        $titre = $request->request->get('titre', '');

        if (empty($titre)) {
            throw new BadRequestHttpException('Title is required');
        }

        $projet->setTitre($titre);
        $entityManager->persist($projet);
        $entityManager->flush();

        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/projet/{projetId}/edit', name: 'edit_projet', methods: ['POST'])]
    public function editProjet($projetId, Request $request, ProjetRepository $projetRepository, EntityManagerInterface $entityManager)
    {
        $projet = $projetRepository->find($projetId); // Load the existing project

        if (!$projet) {
            throw $this->createNotFoundException('Project not found');
        }

        $projet->setTitre($request->request->get('titre'));
        $entityManager->flush(); 

        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/projet/{projetId}/delete', name: 'projet_delete')]
    public function deleteProjet(Request $request, Projet $projet, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($projet);
        $entityManager->flush();

        return $this->redirect($request->headers->get('referer'));
    }

}
