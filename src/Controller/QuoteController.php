<?php

namespace App\Controller;

use App\Entity\Quote;
use App\Entity\User;
use App\Repository\QuoteRepository;
use App\Service\KaamelottQuotes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/quote')]
class QuoteController extends AbstractController
{

    #[Route('/saved', name: 'saved_quotes')]
    public function indexSaved(QuoteRepository $quoteRepository): Response
    {
        $quotes= $quoteRepository->findAll();

        return $this->render('quote/index.html.twig', [
            'quotes' => $quotes,
        ]);
    }

    #[Route('/best', name: 'favorite_quotes')]
    public function favoriteQuotes(QuoteRepository $quoteRepository): Response
    {
        $quotes= $quoteRepository->findAll();
$quotes->findBy($c);

        return $this->render('quote/favorite.html.twig', [
            'quotes' => $quotes,
        ]);
    }


    #[Route('/save', name: 'save_quote')]
    public function save(EntityManagerInterface $manager, QuoteRepository $quoteRepository, Request $request): Response
    {

        $value = $request->get("content");
        $author = $request->get("character");

        $quote = $quoteRepository->findOneBySomeField($value);
        if (!$quote){
            $quote = new Quote();
            $quote->setContent($value);
            $quote->setAuthor($author);
            $quote->setSavedBy($this->getUser());
        }else{
            $this->getUser()->saveQuote($quote);
        }

        $manager->persist($quote);
        $manager->flush();


        return $this->redirectToRoute('app_home');
    }

    #[Route('/unsave/{id}', name: 'unsave_quote')]
    public function unsave(Quote $quote, User $user): Response
    {
        $user=$this->getUser();

        if($quote){
            $user->removeQuote($quote);
        }

        return $this->redirectToRoute('saved_quotes');
    }


}
