<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use App\Entity\Voiture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
    #[Route('/voiture/{id}', name: 'voiture_detail')]
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
}
