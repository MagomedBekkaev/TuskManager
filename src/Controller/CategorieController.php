<?php
namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Form\EditTitleCatType;
use App\Repository\TacheRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/categorie', name: 'app_categorie')]
    public function index(CategorieRepository $categorieRepository, TacheRepository $tacheRepository): Response
    {
        $categories = $categorieRepository->findAll();

        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }
 
    // #[Route('/categorie/new', name: 'app_new_categorie', methods: ['GET', 'POST'])]
    // #[Route('/categorie/{id}/edit', name: 'app_edit_categorie', methods: ['GET', 'POST'])]
    // public function new_editCategorie(Categorie $categorie = null, Request $request, CategorieRepository $categorieRepository, EntityManagerInterface $entityManager): Response
    // {
    //     if(!$categorie) {
    //         $categorie = new Categorie();
    //         $categorie->setUser($this->getUser()); // Set the user before creating the form
    //     }

    //     $form = $this->createForm(CategorieType::class, $categorie);
        
    //     $form->handleRequest($request);
    //     if($form->isSubmitted() && $form->isValid()) {
    //         $categorie = $form->getData();

    //         $entityManager->persist($categorie);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_categorie'); // Redirect after successful form submission
    //         }

    //     return $this->render('categorie/new.html.twig', [
    //         'form' => $form->createView()
    //     ]);
    // }



    #[Route('/categorie/new', name: 'app_new_categorie', methods: ['GET', 'POST'])]
    public function newCategorie(Request $request, CategorieRepository $categorieRepository, EntityManagerInterface $entityManager): Response
    {
            $categorie = new Categorie();
            $categorie->setUser($this->getUser()); // Set the user before creating the form

        $form = $this->createForm(CategorieType::class, $categorie);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();

            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie'); // Redirect after successful form submission
            }

        return $this->render('categorie/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/categorie/{id}/edit', name: 'edit_title', methods: ['POST'])]
    public function editCategorie($id, Request $request, CategorieRepository $categorieRepository, EntityManagerInterface $entityManager)
    {
        $categorie = $categorieRepository->find($id); // Load the existing category
    
        if (!$categorie) {
            throw $this->createNotFoundException('Category not found');
        }
    
        $categorie->setTitre($request->request->get('titre'));
        $entityManager->flush(); 
    
        return $this->redirectToRoute('app_categorie'); // Redirect after successful form submission
    }
    
}