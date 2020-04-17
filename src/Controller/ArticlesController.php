<?php

namespace App\Controller;

use App\Entity\Articles;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticlesController
 * @package App\Controller
 * @Route("/infos", name="infos_")
 */
class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="articles")
     */
    public function index(Request $request, PaginatorInterface$paginator)
    {
        // Liste des articles
        $donnees = $this->getDoctrine()->getRepository(Articles::class)->findBy([],
            [
                'created_at' => 'desc',
            ]);

        $articles = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/{id}", name="article")
     */
    public function article($id)
    {
        $article = $this->getDoctrine()->getRepository(Articles::class)->findOneBy(['id' => $id]);
        if(!$article){
            throw $this->createNotFoundException('L\'article n\'existe pas');
        }

        return $this->render('articles/article.html.twig', compact('article'));
    }
}
