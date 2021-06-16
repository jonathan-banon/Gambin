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
        $item->addProduct($this->getReference('product_0'));
        $item->addAccessory($this->getReference('accessory_0'));
        $item->setRent($this->getReference('rent_0'));
        $manager->persist($item);
        $this->setReference('item_0', $item);

        $item = new Item();
        $item->addProduct($this->getReference('product_0'));
        $item->addAccessory($this->getReference('accessory_0'));
        $item->setRent($this->getReference('rent_1'));
        $manager->persist($item);
        $this->setReference('item_1', $item);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
            AccessoryFixtures::class,
            RentFixtures::class,
        ];
    }
}
