<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\TacheRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(CategorieRepository $categorieRepository, TacheRepository $tacheRepository): Response
{
    $categories = $categorieRepository->findAll();
    $taches = $tacheRepository->findAll();

    // Organisez les tâches par catégorie
    $tachesByCategory = [];
    foreach ($taches as $tache) {
        $categoryId = $tache->getCategorie()->getId();
        $tachesByCategory[$categoryId][] = $tache;
    }

    return $this->render('categorie/index.html.twig', [
        'categories' => $categories,
        'tachesByCategory' => $tachesByCategory,
    ]);
}

}
