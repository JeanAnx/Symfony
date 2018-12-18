<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Proxies\__CG__\App\Entity\Author;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $author1 = new Author();

        $author1
            ->setName('Roger Hanin')
            ->setJob('intern')
            ->setBirth(new \DateTime('1921-03-03'))
            ;

        $author2 = new Author();

        $author2
            ->setName('Marcel Cerdan')
            ->setJob('editor')
            ->setBirth(new \DateTime('1902-12-02'))
        ;

        $manager->persist($author1);
        $this->addReference('author-roger',$author1);

        $manager->persist($author2);
        $this->addReference('author-marcel',$author2);

        $manager->flush();
    }


}
