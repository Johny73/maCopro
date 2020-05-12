<?php

namespace App\Controller;

use App\Entity\Lots;
use App\Form\LotsType;
use App\Repository\LotsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/lots")
 */
class LotsController extends AbstractController
{
    /**
     * @Route("", methods="GET")
     */
    public function index(LotsRepository $repository)
    {

        $lots = $repository->findAll();
        return $this->render('lots/index.html.twig', [
            'controller_name' => 'LotsController',
            'lots' => $lots
        ]);
    }

        /**
     * @Route("/new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $manager)
    {
        $lot = new Lots();
        $form = $this->createForm(LotsType::class, $lot);

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));
        };

        if ($form->isSubmitted() && $form->isValid()) {
                $manager->persist($lot);
                $manager->flush();

                $this->addFlash('success', 'Nouveau Lot ajouté');
                return $this->redirectToRoute('app_lots_index');
        }
        
        return $this->render('lots/new.html.twig', [
            'new_lots_form' => $form->createview(),]);
    }

    /**
     * @Route("/{id}", requirements={"id": "\d+"})
     */
    public function show(Lots $lot, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(LotsType::class, $lot, ['method' => 'POST']);
        $form->HandleRequest($request);

        if ($form->isSubmitted()) {
            if (isset($_POST['edit'])) {
                    $manager->flush();
    
                    $this->addFlash('success', 'Modification enrégistrée');
                    return $this->redirectToRoute('app_lots_show', array('id' => $lot->getId()));
                    }
                }

        return $this->render('lots/show.html.twig', [
            'show_form' => $form->createview(),
            'lot' => $lot,]);
    }

}
