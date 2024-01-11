<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TacheController extends AbstractController
{
    #[Route('/tache', name: 'app_tache')]
    public function index(): Response
    {
        return $this->render('tache/index.html.twig', [
            'controller_name' => 'TacheController',
        ]);
    }

    #[Route('/categorie', name: 'app_new_task', methods: ['GET', 'POST'])]
    public function editCategorie(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Create a new Task entity
        $task = new Task();
    
        // Create a form for the Task
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Set additional properties if needed
            // $task->setSomeProperty($value);
    
            // Persist the new task
            $entityManager->persist($task);
            $entityManager->flush();
    
            // Redirect or show a success message
            return $this->redirectToRoute('app_categorie');
        }
    
        // Render the form in the template
        return $this->render('index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}

