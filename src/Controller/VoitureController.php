<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use App\Entity\Voiture;
use App\Form\VoitureForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class VoitureController extends AbstractController
{
    private VoitureRepository $voitureRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(VoitureRepository $voitureRepository, EntityManagerInterface $entityManager)
    {
        $this->voitureRepository = $voitureRepository;
        $this->entityManager = $entityManager;
    }
    // Page d'accueil listant les voitures
    #[Route('/', name: 'accueil')]
    public function accueil(VoitureRepository $voitureRepository): Response
    {
        $voitures = $voitureRepository->findAll();

        return $this->render('accueil.html.twig', [
            'voitures' => $voitures,
        ]);
    }
    // Page de détail d'une voiture
    #[Route('/voiture/{id}', name: 'voiture_detail', requirements: ['id' => '\d+'])]
    public function detail(Voiture $voiture): Response
    {
        return $this->render('voiture.html.twig', [
            'voiture' => $voiture,
        ]);
    }
    // Suppression d'une voiture
    #[Route('/voiture/{id}/supprimer', name: 'voiture_supprimer')]
    public function supprimerVoiture(int $id): Response
    {
        $voiture = $this->voitureRepository->find($id);

        if(!$voiture) {
            return $this->redirectToRoute('accueil');
        }

        $this->entityManager->remove($voiture);
        $this->entityManager->flush();

        return $this->redirectToRoute('accueil');
    }

    //Ajout d'une voiture
    #[Route('/voiture/ajout', name: 'voiture_ajout')]
    public function ajoutVoiture(Request $request): Response
    {
        $voiture = new Voiture();

        $form = $this->createForm(VoitureForm::class, $voiture);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $voiture = $form->getData();

            $this->entityManager->persist($voiture);
            $this->entityManager->flush();

            return $this->redirectToRoute('voiture_detail', ['id' => $voiture->getId()]);
        }

        return $this->render('ajout.html.twig', [
            'form' => $form->createView(), 
        ]);
    }
}
