<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AuthorFixtures extends Fixture implements DependentFixtureInterface
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
            ->setUser($this->getReference('user_roger'))
            ;

        $author2 = new Author();

        $author2
            ->setName('Marcel Cerdan')
            ->setJob('editor')
            ->setBirth(new \DateTime('1902-12-02'))
            ->setUser($this->getReference('user_marcel'))

        ;

        $manager->persist($author1);
        $this->addReference('author-roger',$author1);

        $manager->persist($author2);
        $this->addReference('author-marcel',$author2);

        $manager->flush();

    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }


}
