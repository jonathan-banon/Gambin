<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public const NAME = [
        'available',
        'cart',
        'reserved',
        'getBack',
        'cleaning',
    ];

    public function load(ObjectManager $manager)
    {
        for($i = 0; $i <count(self::NAME); $i++) {
            $status = new Status();
            $status->setName(self::NAME[$i]);
            $manager->persist($status);
            $this->setReference('status_' . $i, $status);
        }
        $manager->flush();
    }
}
