<?php

namespace App\Controller;

use App\Entity\Comptes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Journal;
use App\Form\HistoComptaType;
use App\Form\JournalTdbType;
use App\Form\JournalType;
use App\Repository\JournalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/compta")
 */
class ComptaController extends AbstractController
//Pour la mise en place de modification de journal, regarder boardgames.index
{
    /**
     * @Route("", methods="GET")
     */
      public function index(JournalRepository $repository, EntityManagerInterface $em)
    {   $year = 2020;
        $ecritures = $repository->findWithLabels();
        $comptesRepository = $em->getRepository(Comptes::class);
        $tdb = $repository->createJournalTdb($comptesRepository, $year);
        $journal = new Journal();
        $form = $this->createForm(HistoComptaType::class, $journal);
        $form2 = $this->createForm(JournalTdbType::class);


        return $this->render('compta/index.html.twig', [
            'histo_form' => $form->createView(),
            'ecritures' => $ecritures,
            'journal' => $tdb,
            'tdb_form' => $form2->createview(),
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