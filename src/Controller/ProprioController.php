<?php

namespace App\Controller;

use App\Entity\Proprietaires;
use App\Form\ProprioType;
use App\Repository\ProprietairesRepository;
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
    * @Route("", methods="GET")
    */
    public function index(ProprietairesRepository $repository)
    {
        $proprios = $repository->findAll();


        return $this->render('proprio/index.html.twig', [
            'proprios' => $proprios,
        ]);
    }

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
    /**
     * @Route("/{id}", requirements={"id": "\d+"})
     */
    public function show(Proprietaires $proprio)
    {
        return $this->render('proprio/show.html.twig', [
            'proprio' => $proprio,
        ]);
    }
}
