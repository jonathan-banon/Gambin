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
        $pack->setPricePerDay(500);
        $pack->setPriceService(25);
        $pack->setDescription('Pack Nature');
        $manager->persist($pack);
        $this->setReference('pack_0', $pack);

        $pack = new Pack();
        $pack->setName('Plage');
        $pack->setIdentifier('beach');
        $pack->setPricePerDay(500);
        $pack->setPriceService(25);
        $pack->setDescription('Pack Plage');
        $manager->persist($pack);
        $this->setReference('pack_1', $pack);

        $pack = new Pack();
        $pack->setName('Ville');
        $pack->setIdentifier('ville');
        $pack->setPricePerDay(500);
        $pack->setPriceService(25);
        $pack->setDescription('Pack Ville');
        $manager->persist($pack);
        $this->setReference('pack_2', $pack);

        $manager->flush();
    }
}
