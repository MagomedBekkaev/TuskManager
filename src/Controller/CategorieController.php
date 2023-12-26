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

        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }
 
    #[Route('/categorie/editTitle/{id}', name: 'app_edit_categorie')]
    public function editTitle(Categorie $categorie,Request $request, CategorieRepository $categorieRepository, EntityManagerInterface $entityManager): Response
    {
        
        
    }
}
