<?php
namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Form\EditTitleCatType;
use App\Repository\TacheRepository;
use App\Repository\ProjetRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CategorieController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('projet/{projetId}', name: 'app_categorie')]
    public function index($projetId, ProjetRepository $projetRepository, CategorieRepository $categorieRepository): Response
{
    $projet = $projetRepository->find($projetId);

    // Check if the project exists and belongs to the logged-in user
    if (!$projet || $projet->getUser() !== $this->getUser()) {
        throw $this->createNotFoundException('Project not found or access denied.');
    }

    $categories = $categorieRepository->findBy(['projet' => $projetId]);

    return $this->render('categorie/index.html.twig', [
        'categories' => $categories,
        'projet' => $projet,
    ]);
}


 
    #[Route('/categorie/new/{projetId}', name: 'new_categorie', methods: ['POST'])]
    public function newCategorie($projetId, Request $request, CategorieRepository $categorieRepository, EntityManagerInterface $entityManager, ProjetRepository $projetRepository): Response
    {
        $projet = $projetRepository->find($projetId);
        $categorie = new Categorie();
        $categorie->setProjet($projet);

        $titre = $request->request->get('titre', '');

        if (empty($titre)) {
            throw new BadRequestHttpException('Title is required');
        }

        $categorie->setTitre($titre);
        $categorie->setProjet($projet);

        $entityManager->persist($categorie);
        $entityManager->flush();

        return $this->redirect($request->headers->get('referer'));
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
    
        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/categorie/{id}/delete', name: 'categorie_delete')]
    public function deleteCategorie (Request $request, Categorie $categorie, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($categorie);
        $entityManager->flush();

        return $this->redirect($request->headers->get('referer'));
    }
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



    // #[Route('/categorie/new', name: 'app_new_categorie', methods: ['GET', 'POST'])]
    // public function newCategorie(Request $request, CategorieRepository $categorieRepository, EntityManagerInterface $entityManager): Response
    // {
    //         $categorie = new Categorie();
    //         $categorie->setUser($this->getUser()); // Set the user before creating the form

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

        // #[Route('/categorie/new', name: 'app_new_categorie', methods: ['GET', 'POST'])]
    // public function newCategorie(Request $request, CategorieRepository $categorieRepository, EntityManagerInterface $entityManager): Response
    // {
    //         $categorie = new Categorie();
    //         $categorie->setUser($this->getUser()); // Set the user before creating the form

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