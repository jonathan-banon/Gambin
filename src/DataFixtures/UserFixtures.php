<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
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
        $user = new User();
        $user->setEmail('test@gmail.com');
        $user->setFirstName('NomTest');
        $user->setLastName('PrénomTest');
        $password = $this->encoder->encodePassword($user, 'test');
        $user->setPassword($password);
        $manager->persist($user);
        $this->addReference('user_0', $user);

        $user = new User();
        $user->setEmail('test1@gmail.com');
        $user->setFirstName('Nom1Test');
        $user->setLastName('Prénom1Test');
        $password = $this->encoder->encodePassword($user, 'test');
        $user->setPassword($password);
        $manager->persist($user);
        $this->addReference('user_1', $user);

        $manager->flush();
    }
}
