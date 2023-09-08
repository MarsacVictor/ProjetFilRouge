<?php

namespace App\Controller;

use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListRealisationController extends AbstractController
{
    #[Route('/list/realisation', name: 'app_list_realisation')]
    public function index(RealisationRepository $realisationRepository): Response
    {
        $realisations = $realisationRepository->findAll();

        return $this->render('list_realisation/index.html.twig', [
            'controller_name' => 'ListRealisationController',
            'realisations' => $realisations
        ]);
    }
    #[Route('/voir/{id}', name: 'app_voir_realisation')]
    public function voirBien(RealisationRepository $realisationRepository,
                             int $id): Response {

        $realisation = $realisationRepository->find($id);


        return $this->render('list_realisation/acheter_realisation.html.twig',
            [
                'controller_name' => 'acheter_realisation',
                'realisation' => $realisation,
            ]);
    }
}
