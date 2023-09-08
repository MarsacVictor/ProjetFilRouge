<?php

namespace App\Controller;

use App\Entity\Acheteur;
use App\Entity\Bien;
use App\Form\AcheteurType;
use App\Form\BienType;
use App\Repository\AcheteurRepository;
use App\Repository\BienRepository;
use App\Repository\RealisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/acheter', name: 'app_acheteur')]
class AcheteurController extends AbstractController
{
    #[Route('/', name: '_acheter')]
    public function index(Request $request,
                          EntityManagerInterface $entityManager,
                          AcheteurRepository $acheteurRepository,
                          SluggerInterface $slugger,
                          RealisationRepository $realisationRepository): Response {

        $acheteur = new Acheteur();


        $form = $this->createForm(AcheteurType::class, $acheteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $realisation = $realisationRepository->find($acheteur->getRealisation());
            $realisation->setVendu(true);
            $realisation->setAchetable(false);
            $entityManager->persist($realisation);
            $entityManager->persist($acheteur);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'L achat a bien été réalisé '
            );

            return $this->redirectToRoute('app_accueil_lister');
        }

        return $this->render('acheteur/index.html.twig',
            [
                'form' => $form,
            ]);
    }
}