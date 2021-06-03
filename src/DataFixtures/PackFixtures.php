<?php

namespace App\DataFixtures;

use App\Entity\Pack;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PackFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $pack = new Pack();
        $pack->setName('Nature');
        $pack->setIdentifier('nature');
        $pack->setPrice(500);
        $manager->persist($pack);

        $pack = new Pack();
        $pack->setName('Plage');
        $pack->setIdentifier('beach');
        $pack->setPrice(500);
        $manager->persist($pack);

        $pack = new Pack();
        $pack->setName('Ville');
        $pack->setIdentifier('ville');
        $pack->setPrice(500);
        $manager->persist($pack);

        $manager->flush();
    }
}
