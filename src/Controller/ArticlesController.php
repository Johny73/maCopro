<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Commentaires;
use App\Form\CommentaireFormType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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
    public function index(Request $request, PaginatorInterface $paginator)
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
     * @Route("/{slug}", name="article")
     */
    public function article($slug, Request $request)
    {
        $article = $this->getDoctrine()->getRepository(Articles::class)->findOneBy(['slug' => $slug]);
        if(!$article){
            throw $this->createNotFoundException('L\'article n\'existe pas');
        }

        $commentaire = new Commentaires();

        $form = $this->createForm(CommentaireFormType::class, $commentaire);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $commentaire->setArticles($article);

            $commentaire->setCreatedAt(new \DateTime('now'));

            $doctrine = $this->getDoctrine()->getManager();

            $doctrine->persist($commentaire);

            $doctrine->flush();
        }

        return $this->render('articles/article.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
            ]);
    }
}
