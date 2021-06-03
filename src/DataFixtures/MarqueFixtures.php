<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MarqueFixtures extends Fixture
{

    public const COMPANY = [
        'Babyzen',
        'Babyjorn',
        'Ergobaby',
        'Stokke',
    ];


    public function load(ObjectManager $manager)
    {
        foreach (self::COMPANY as $key => $companyName) {
            $marque = new Marque();
            $marque->setName($companyName);
            $manager->persist($marque);
            $this->addReference('marque_' . $key, $marque);
        }
        $manager->flush();
    }
}
