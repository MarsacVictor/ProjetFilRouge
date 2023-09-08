<?php

namespace App\Controller;

use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/accueil', name: 'app_accueil')]
class AccueilController extends AbstractController
{
    #[Route('/', name: '_lister')]
    public function index(RealisationRepository $realisationRepository): Response
    {
        $realisations = $realisationRepository->findAll();

        return $this->render('accueil/index.html.twig', [
            'realisations' => $realisations,
        ]);
    }
}