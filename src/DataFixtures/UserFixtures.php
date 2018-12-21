<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $u1 = new User();
        $u1
            ->setEmail('marcel.cerdan@yahoo.fr')
            ->setPassword($this->encoder->encodePassword($u1,'marcel'));

        $manager->persist($u1);
        $this->addReference('user_marcel',$u1);

        $u2 = new User();
        $u2
            ->setEmail('roger.hanin@yahoo.fr')
            ->setPassword($this->encoder->encodePassword($u1,'roger'));

        $manager->persist($u2);
        $this->addReference('user_roger',$u2);

        $manager->flush();
    }
}
