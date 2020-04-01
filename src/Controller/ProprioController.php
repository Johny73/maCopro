<?php

namespace App\Controller;

use App\Entity\Proprietaires;
use App\Form\ProprioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/proprio")
 */
class ProprioController extends AbstractController
{


    /**
     * @Route("/new", methods={"GET", "POST"})
     */
    public function new (Request $request, EntityManagerInterface $manager)
    {
        $Proprio = new Proprietaires();
        $form = $this->createForm(ProprioType::class, $Proprio);

        $form->HandleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($Proprio);
            $manager->flush();

            $this->addFlash('succes', 'Nouveau copropriétaire ajouté');
            return $this->redirectToRoute('app_proprio_new');
        }

        return $this->render('proprio/new.html.twig',[
            'new_form' => $form->createview(),
        ]);
    }
}
