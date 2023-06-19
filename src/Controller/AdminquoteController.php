<?php

namespace App\Controller;

use App\Entity\Quote;
use App\Entity\User;
use App\Repository\QuoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminquoteController extends AbstractController
{
    #[Route('/', name: 'all_saved_quotes')]
    public function indexSaved(QuoteRepository $quoteRepository): Response
    {
        $quotes= $quoteRepository->findAll();

        return $this->render('adminquote/index.html.twig', [
            'quotes' => $quotes,
        ]);
    }


    #[Route('/admin/remove/{id}', name: 'remove_quote')]
    public function remove(Quote $quote, EntityManagerInterface $manager): Response
    {
        if($quote){
            $manager->remove($quote);
            $manager->flush();
        }

        return $this->redirectToRoute('all_saved_quotes');
    }
}
