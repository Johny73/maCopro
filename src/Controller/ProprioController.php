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

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));
        };

        if ($form->isSubmitted() && $form->isValid()) {
                $manager->persist($proprio);
                $manager->flush();

                $this->addFlash('success', 'Nouveau copropriétaire ajouté');
                return $this->redirectToRoute('app_proprio_index');
        }
        return $this->render('proprio/new.html.twig', [
            'new_proprio_form' => $form->createview(),]);
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
                    $manager->flush();
    
                    $this->addFlash('success', 'Modification enrégistrée');
                    return $this->redirectToRoute('app_proprio_show', array('id' => $proprio->getId()));
                    }
                }

        return $this->render('proprio/show.html.twig', [
            'show_form' => $form->createview(),
            'proprio' => $proprio,]);
    }

}
