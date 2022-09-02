<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private readonly CategoryRepository $categoryRepository){}

    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(): Response
    {

        return $this->render('/index.html.twig', [
            'categorys' => $this->categoryRepository->findAll(),
        ]);
    }

    #[Route('/panier', name: 'basket', methods: ['GET'])]
    public function basket(): Response
    {

        return $this->render('/panier/index.html.twig', [
        ]);
    }
}
