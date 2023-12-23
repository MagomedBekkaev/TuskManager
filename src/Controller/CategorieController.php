<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\EditTitleCatType;
use App\Repository\TacheRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(CategorieRepository $categorieRepository, TacheRepository $tacheRepository): Response
    {
        $categories = $categorieRepository->findAll();
        $taches = $tacheRepository->findBy([], ["dateCreation" => "ASC"]);

        // Organisez les tâches par catégorie
        $tachesByCategory = [];
        foreach ($categories as $categorie) {
            $tachesByCategory[$categorie->getId()] = []; // Initialisez le tableau même si la catégorie n'a pas de tâches
        }

        foreach ($taches as $tache) {
            $categoryId = $tache->getCategorie()->getId();
            $tachesByCategory[$categoryId][] = $tache;
        }

        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
            'tachesByCategory' => $tachesByCategory,
        ]);
    }

    #[Route('/editTitle/{id}', name: 'app_edit_categorie')]
    public function editTitle(Request $request, CategorieRepository $categorieRepository, EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'utilisateur en session
        $user = $this->getUser();

        // Récupérer l'objet catégorie a modifier
        $categorie = $user->getCategorie()

        $form = $this->createForm(EditTitleCatType::class);

        $form->handleRequest($request);

        if($form->isSubmitted && $form->isValid()) {
            
            $entityManager->persist($categorie)

        }
    }
}
