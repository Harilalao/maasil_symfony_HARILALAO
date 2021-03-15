<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ArticleController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     */
    public function home(ArticleRepository $repArticle): Response
    {
        return $this->render('home.html.twig', [
            'articles' => $repArticle->findBy(array(), array('createdAt' => 'DESC'), 5, 0)
        ]);
    }

    /**
     * @Route("/article", name="article")
     *
     */
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    /**
     * @Route("/article-{id}/show", name="show_article")
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/article-create", name="create_article")
     * @IsGranted("ROLE_USER")
     *
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('create_article', []);
        }
        return $this->render('article/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
