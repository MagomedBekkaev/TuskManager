<?php

namespace App\Controller;

use DateTime;
use App\Entity\Tache;
use App\Form\CategorieType;
use App\Repository\UserRepository;
use App\Repository\TacheRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TacheController extends AbstractController
{
    #[Route('/tache', name: 'app_tache')]
    public function index(): Response
    {
        return $this->render('tache/index.html.twig', [
            'controller_name' => 'TacheController',
        ]);
    }

    #[Route('/tache/{id}/new', name: 'new_task', methods: ['POST'])]
    public function newTache(UserRepository $userRepository, Request $request, TacheRepository $tacheRepository, CategorieRepository $categorieRepository, EntityManagerInterface $entityManager, Security $security, $id): Response
    {
        // Get the currently logged-in user
        $user = $security->getUser();

        if (!$user) {
            throw new BadRequestHttpException('User must be logged in');
        }

        $categorieId = $request->request->get('categorie_id');
        $categorie = $categorieRepository->find($categorieId);
        if (!$categorie) {
            throw new BadRequestHttpException('Category not found');
        }
    
        $titre = $request->request->get('titre', '');
        if (empty($titre)) {
            throw new BadRequestHttpException('Title is required');
        }
    
        $tache = new Tache();
        $tache->setUser($user);
        $tache->setCategorie($categorie);
        $tache->setTitre($titre);
        $tache->setDateCreation(new \DateTime('now'));
        $tache->setDescription($request->request->get('description'));
    
        $entityManager->persist($tache);    
        $entityManager->flush();
    
        return $this->redirectToRoute('app_categorie');
    }


    #[Route('/tache/{id}/edit', name: 'edit_tache_title', methods: ['POST'])]
    public function editTache($id, Request $request, TacheRepository $tacheRepository, EntityManagerInterface $entityManager)
    {
        $tache = $tacheRepository->find($id);

        if (!$tache) {
            throw $this->createNotFoundException('Task not found');
        }

        $tache->setTitre($request->request->get('titre'));
        $tache->setDescription($request->request->get('description'));
        $entityManager->flush(); 

        return $this->redirectToRoute('app_categorie'); // Redirect after successful form submission
    }



    #[Route('/tache/{id}/delete', name: 'task_delete')]
    public function deleteTache (Tache $tache, EntityManagerInterface $entityManager){
        $entityManager->remove($tache);
        $entityManager->flush();

        return $this->redirectToRoute('app_categorie');
    }


    // #[Route('/tache', name: 'app_new_task', methods: ['GET', 'POST'])]
    // public function editCategorie(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     // Create a new Task entity
    //     $task = new Task();
    
    //     // Create a form for the Task
    //     $form = $this->createForm(TaskType::class, $task);
    //     $form->handleRequest($request);
    
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         // Set additional properties if needed
    //         // $task->setSomeProperty($value);
    
    //         // Persist the new task
    //         $entityManager->persist($task);
    //         $entityManager->flush();
    
    //         // Redirect or show a success message
    //         return $this->redirectToRoute('app_categorie');
    //     }
    
    //     // Render the form in the template
    //     return $this->render('index.html.twig', [
    //         'form' => $form->createView(),
    //     ]);
    // }
    
}

