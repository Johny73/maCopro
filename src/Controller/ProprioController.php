<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProprioController extends AbstractController
{
    /**
     * @Route("/proprio", name="proprio")
     */
    public function index()
    {
        return $this->render('proprio/index.html.twig', [
            'controller_name' => 'ProprioController',
        ]);
    }
}
