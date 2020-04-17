<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comptes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/new", methods="GET")
     */
    public function new(Request $request)
    {   $defaultData = ['message' => 'Sélectionnez un compte'];
        $form = $this->createFormBuilder($defaultData)

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
        ->add('save', SubmitType::class, ['label' => 'Valider'])

        ->getForm();
       
        return $this->render('compta/new.html.twig', [
            'controller_name' => 'ComptaController',
                'new_compta_form' => $form->createview(),
            
        ]);
    }


}