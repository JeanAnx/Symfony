<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(ArticleRepository $repository)
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $repository->findAll()
        ]);
    }

    /**
     * @Route("/article/create", name="new_article")
     */
    public function create(EntityManagerInterface $manager , Request $request)
    {
        $form = $this
            ->createForm(ArticleType::class , new Article());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('article');
        }

        return $this->render('article/create.html.twig',[
            'form' => $form->createView(),
        ]);

    }
}
