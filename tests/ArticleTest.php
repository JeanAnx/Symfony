<?php

namespace App\Tests;

use App\Entity\Article;
use App\Entity\Author;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testCreate()
    {
        $article = new Article();
        $this->assertNull($article->getId());
        $this->assertInstanceOf(\DateTime::class, $article->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $article->getUpdatedAt());
        $this->assertFalse($article->getStatus());

        return $article;
    }

    /**
     * @depends testCreate
     */

    public function testFill(Article $article): Article
    {
        $article
            ->setTitle('Ze Titre')
            ->setContent('Ze Contenu of ze article')
            ->setStatus(true)
            ->setUpdatedAt(new \DateTime())
        ;

        $this->assertEquals($article->getTitle(), 'Ze Titre');
        $this->assertEquals($article->getContent(), 'Ze Contenu of ze article');
        $this->assertTrue($article->getStatus());
        $this->assertInstanceOf(\DateTime::class , $article->getUpdatedAt());

        return $article;
    }

    /**
     * @dataProvider provideArticles
     */
    public function testManyArticles($title , $content , $status)
    {

        $article = new Article();

        $article
            ->setTitle($title)
            ->setContent($content)
            ->setStatus($status)
        ;

        $this->assertEquals($title , $article->getTitle());
        $this->assertEquals($content , $article->getContent());
        $this->assertEquals($status , $article->getStatus());

    }

    public function provideArticles(): array
    {
        return [
            ['Hourra' , 'C\'est la fête !' , true],
            ['Ceci n\'est pas un titre' , 'Cela est la fête dis donc' , false],
        ];
    }

    /**
     * @depends testFill
     */

    public function testSetAuthor(Article $article)
    {
        $author = $this->createMock(Author::class);

        $author
            ->method('getName')->willReturn('Bruno');

        $article->setAuthor($author);

        $this->assertInstanceOf(Author::class , $article->getAuthor());
    }
}
