<?php

namespace App\Controller\Admin;

use App\Repository\AcheteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/admin/acheteur', name: 'app_admin_acheteur')]
class AdminAcheteurController extends AbstractController
{
    #[Route('/', name: '_lister')]
    public function index(AcheteurRepository $acheteurRepository): Response
    {
        $acheteurs = $acheteurRepository->findAll();
        return $this->render('admin/admin_acheteur/index.html.twig', [
            'acheteurs' => $acheteurs
        ]);
    }
}
