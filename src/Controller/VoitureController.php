<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use App\Entity\Voiture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VoitureController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function accueil(VoitureRepository $voitureRepository): Response
    {
        $voitures = $voitureRepository->findAll();

        return $this->render('accueil.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    #[Route('/voiture/{id}', name: 'voiture_detail')]
    public function detail(Voiture $voiture): Response
    {
        return $this->render('voiture.html.twig', [
            'voiture' => $voiture,
        ]);
    }
}
