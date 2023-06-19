<?php

namespace App\Controller;

use App\Service\KaamelottQuotes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    #[Route('/', name: 'app_home')]
    public function index(KaamelottQuotes $kaamelottQuotes): Response
    {
        $quote=$kaamelottQuotes->fetchQuote();

        return $this->render('home/index.html.twig', [
            'quote' => $quote,
        ]);
    }
}
