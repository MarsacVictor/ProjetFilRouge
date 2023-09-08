<?php

namespace App\Controller\Admin;

use App\Entity\Realisation;
use App\Form\RealisationType;
use App\Repository\RealisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/fil_rouge', name: 'app_admin')]
class AdminFilRougeController extends AbstractController
{
    #[Route('/', name: '_lister')]
    public function index(RealisationRepository $realisationRepository): Response
    {
        $realisation = $realisationRepository->findAll();
        return $this->render('admin/admin_fil_rouge/index.html.twig', [
            'controller_name' => 'AdminFilRougeController',
            'realisations' => $realisation
        ]);
    }
    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier/{id}', name: '_modifier')]
    public function editerRealisation(Request $request,
                                      EntityManagerInterface $entityManager,
                                      RealisationRepository $realisationRepository,
                                      int $id = null,
                                      SluggerInterface $slugger): Response {


        if($id == null) {
            $realisation = new Realisation();
        } else {
            $realisation = $realisationRepository->find($id);
        }

        $form = $this->createForm(RealisationType::class, $realisation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imageRealisation = $form->get('imageRealisation')->getData();
            if ($imageRealisation) {
                $originalFilename = pathinfo($imageRealisation->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageRealisation->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $imageRealisation->move(
                        $this->getParameter('image_realisation'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                $realisation->setImageRealisation($newFilename);
                $entityManager->persist($realisation);
                $entityManager->flush();

                $this->addFlash(
                    'notice',
                    'La réalisation a été ' . ($id == null ? 'ajouter' : 'modifier')
                );
                return $this->redirectToRoute('app_admin_lister');
            }
        }
            return $this->render('admin/projet/editeProjet.html.twig', [
                'controller_name' => 'AdminFilRougeAjouter',
                'form' => $form,
            ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer')]
    public function supprimerRealisation(EntityManagerInterface $entityManager,
                                  RealisationRepository $realisationRepository,
                                  int $id): Response {
        $realisation = $realisationRepository->find($id);
        $entityManager->remove($realisation);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'La réalisation a été supprimer'
        );
        return $this->redirectToRoute('app_admin_lister');
    }
}
