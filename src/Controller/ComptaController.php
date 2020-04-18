<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comptes;
use App\Entity\Journal;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

/**
 * @Route("/compta")
 */
class ComptaController extends AbstractController
{
    /**
     * @Route("", methods="GET")
     */
      public function index()
    {
        return $this->render('compta/index.html.twig', [
            'controller_name' => 'ComptaController',
        ]);
    }

        /**
     * @Route("/new", methods={"POST", "GET"})
     */
    public function new(Request $request, EntityManagerInterface $manager)
    {  
        $defaultData = ['message' => 'Sélectionnez un compte'];
        $form = $this->createFormBuilder($defaultData)
        ->add('date', DateType::class, ['widget' => 'single_text',] )
        ->add('montant', NumberType::class)
        ->add('choixCompte1', EntityType::class, [
            'class' => Comptes::class,
            'choice_label' => 'labelCompte',
            'label' => 'Compte à débiter'
        ])
        ->add('choixCompte2', EntityType::class, [
            'class' => Comptes::class,
            'choice_label' => 'labelCompte',
            'label' => 'Compte à créditer',
        ])
        ->add('commentaire', TextType::class)
        ->add('save', SubmitType::class, ['label' => 'Valider','attr' => ['class' => 'btn btn-primary'],])

        ->getForm();

        $form->handleRequest($request);
      
        if ($form->isSubmitted() && $form->isValid() ) {
            $date = $form['date']->getData();
            $montant = $form['montant']->getData();
           
            
            $compteDebit = $form['choixCompte1']->getData()->getId();
            $compteCredit = $form['choixCompte2']->getData()->getId();
            $commentaire = $form['commentaire']->getData();
            $this->ajoutJournal($date, $montant, $compteDebit, $compteCredit, $commentaire);
            return $this->redirectToRoute('app_compta_index');
            }
       
        return $this->render('compta/new.html.twig', [
            'controller_name' => 'ComptaController',
                'new_compta_form' => $form->createview(),
            
        ]);
    }

    public function ajoutJournal($date, $montant, $compteDebit, $compteCredit, $commentaire): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $journalEvent = new Journal();
        $journalEvent->setDate($date);
        $journalEvent->setMontant($montant);
        $journalEvent->setCompteDebit($compteDebit);
        $journalEvent->setCompteCredit($compteCredit);
        $journalEvent->setCommentaire($commentaire);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($journalEvent);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('écriture a été ajouté ');
    }


}