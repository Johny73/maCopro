<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/macopro")
 */
class MaCoproController extends AbstractController
{
    /**
     * @Route("", methods="GET")
     */
      public function index()
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'MaCoproController',
        ]);
    }
}
