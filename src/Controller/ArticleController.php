<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\AuthorRepository;
use App\Utils\Congratulator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(ArticleRepository $repository , AuthorRepository $authorRepository , TranslatorInterface $translator)
    {
        $articles = $repository->findLatest(10);

        $message = new Congratulator($authorRepository , $translator);

        dump($message->thank());

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/admin/create", name="new_article" , methods={"GET" , "POST"})
     */
    public function create(
        TranslatorInterface $translator ,
        EntityManagerInterface $manager,
        Request $request
    )
    {
        $form = $this
            ->createForm(ArticleType::class, new Article());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $manager->persist($article);
            $manager->flush();
            $this->addFlash('success' ,
                $translator->trans(
                    'flash.success.article_created',
                    ['%id' => $article->getId()]
                    ));

            return $this->redirectToRoute('article');
        }

        return $this->render('article/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article/{id}", name="show_article" , methods={"GET"})
     */
    public function show(Article $article)
    {
        $form = $this->createForm(FormType::class, null, [
            'method' => 'DELETE',
            'action' => $this->generateUrl('article_delete' , [ 'id' => $article->getId() ]),
        ]);

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'delete_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/article/{id}", name="edit_article" , methods={"PUT","GET"})
     */
    public function edit(Article $article, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ArticleType::class, $article , ['method' => 'PUT']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setUpdatedAt(new \DateTime());
            $manager->flush();

            return $this->redirectToRoute('show_article', ['id' => $article->getId()]
            );
        }

        return $this->render('article/edit.html.twig', [
            'form' => $form->createView()
        ]);
        
    }

    /**
     * @Route ("/admin/article/{id}" , name="article_delete" , methods={"DELETE"})
     */

    public function delete(Article $article , EntityManagerInterface $manager)
    {
        $manager->remove($article);
        $manager->flush();

        return $this->redirectToRoute('article');
    }
}
