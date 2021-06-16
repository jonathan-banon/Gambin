<?php

namespace App\DataFixtures;

use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ItemFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $item = new Item();
        $item->setRent($this->getReference('rent_0'));
        $manager->persist($item);
        $this->setReference('item_0', $item);

        $item = new Item();
        $item->setRent($this->getReference('rent_1'));
        $manager->persist($item);
        $this->setReference('item_1', $item);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RentFixtures::class,
        ];
    }
}
