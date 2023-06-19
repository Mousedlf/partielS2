<?php

namespace App\Controller;

use App\Repository\QuoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ApiController extends AbstractController
{
    // route /api/login_check -> obtention token

    #[Route('/quotes', name: 'app_api', methods: ['GET'])]
    public function index(QuoteRepository $quoteRepository): Response
    {
        $quotes=$quoteRepository->findBy(['savedBy'=> $this->getUser()], ['id' => 'ASC']);

        $firstThreeElements = array_slice($quotes, 0, 3);

        return $this->json($firstThreeElements, 200, [], ['groups'=> 'quote:read']);
    }
}
