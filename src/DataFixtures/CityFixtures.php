<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\City;

class CityFixtures extends Fixture
{
    public const CITIES = [
        'Bordeaux',
        'Toulouse',
    ];

    public function load(ObjectManager $manager)
    {

        foreach (self::CITIES as $key => $cityName) {
            $city = new City();
            $city->setName($cityName);
            $manager->persist($city);
            $this->addReference('city_' . $key, $city);
        }

        $manager->flush();
    }
}
