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
    public function new(Request $request, EntityManagerInterface $manager)
    {
        $proprio = new Proprietaires();
        $form = $this->createForm(ProprioType::class, $proprio);

        $form->HandleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (isset($_POST['return'])) {
                return $this->redirectToRoute('app_proprio_index');
            } elseif (isset($_POST['new'])) {
                $manager->persist($proprio);
                $manager->flush();

                $this->addFlash('succes', 'Nouveau copropriétaire ajouté');
                return $this->redirectToRoute('app_proprio_index');
            }
        }
        return $this->render('proprio/new.html.twig', [
            'new_form' => $form->createview(),]);
    }

    /**
     * @Route("/{id}", requirements={"id": "\d+"})
     */
    public function show(Proprietaires $proprio, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ProprioType::class, $proprio, ['method' => 'POST']);
        $form->HandleRequest($request);

        if ($form->isSubmitted()) {
            if (isset($_POST['edit'])) {
                return $this->redirectToRoute('app_proprio_edit', array('id' => $proprio->getId()));
            } elseif (isset($_POST['return'])) {
                return $this->redirectToRoute('app_proprio_index');
            }
        }

        return $this->render('proprio/show.html.twig', [
            'show_form' => $form->createview(),
            'proprio' => $proprio,]);
    }

    /**
     * @Route("/edit/{id}", requirements={"id": "\d+"})
     */
    public function edit(Proprietaires $proprio, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ProprioType::class, $proprio, ['method' => 'POST']);
        $form->HandleRequest($request);

        if ($form->isSubmitted()) {
            if (isset($_POST['valid'])) {
                $manager->persist($proprio);
                $manager->flush();

                $this->addFlash('succes', 'Nouveau copropriétaire ajouté');

                return $this->redirectToRoute('app_proprio_show', array('id' => $proprio->getId()));
            } elseif (isset($_POST['return'])) {
                return $this->redirectToRoute('app_proprio_index');
            }
        }

        return $this->render('proprio/edit.html.twig', [
            'edit_form' => $form->createview(),
            'proprio' => $proprio,]);
    }
}
