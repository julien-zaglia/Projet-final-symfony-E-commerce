<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ProduitRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(ProduitRepository $pRepo): Response
    {
        $user = $this->getUser();
        $produits = $pRepo->getProduitsByUser($user);
        // cette méthode retourne les produits appartenant à l'utilisateur passé en argument

        return $this->render('profil/index.html.twig', [
            'produits' => $produits
        ]);
    }
}
