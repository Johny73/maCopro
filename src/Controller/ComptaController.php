<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Journal;
use App\Form\HistoComptaType;
use App\Form\JournalType;
use App\Repository\JournalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/compta")
 */
class ComptaController extends AbstractController
{
    /**
     * @Route("", methods="GET")
     */
      public function index(JournalRepository $repository)
    {
        $ecritures = $repository->findWithLabels();
        $journal = new Journal();
        $form = $this->createForm(HistoComptaType::class, $journal);

        return $this->render('compta/index.html.twig', [
            'histo_form' => $form->createView(),
            'ecritures' => $ecritures,
        ]);
    }

        /**
     * @Route("/new", methods={"POST", "GET"})
     */
    public function new(Request $request, EntityManagerInterface $manager)
    {  
        $journal = new Journal();
        $form = $this->createForm(JournalType::class, $journal);

        $form->handleRequest($request);
      
        if ($form->isSubmitted() && $form->isValid() ) {
          
                $manager->persist($journal);
                $manager->flush();
           
            return $this->redirectToRoute('app_compta_index');
        }
       
        return $this->render('compta/new.html.twig', [
            'controller_name' => 'ComptaController',
                'new_compta_form' => $form->createview(),
            
        ]);
    }


}