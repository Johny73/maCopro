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
     * @Route("/new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $manager)
    {  
        $defaultData = ['message' => 'Sélectionnez un compte'];
        $form = $this->createFormBuilder($defaultData)
        ->add('date', DateType::class, ['widget' => 'single_text',] )
        ->add('Montant', MoneyType::class)
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
        ->add('Commentaire', TextType::class)
        ->add('saveg', SubmitType::class, ['label' => 'Valider'])

        ->getForm();

        if ($form->isSubmitted() /*&& $form->isValid()*/) {
            $this->ajoutJournal($_POST['montant']);
             /*   return $this->redirectToRoute('app_compta_index');*/
            }
           
         
           
       
        return $this->render('compta/new.html.twig', [
            'controller_name' => 'ComptaController',
                'new_compta_form' => $form->createview(),
            
        ]);
    }

    public function ajoutJournal($montant): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $journalEvent = new Journal();
        $journalEvent->setMontant($montant);
       

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($journalEvent);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('L\écriture a été ajouté ');
    }


}