<?php

namespace App\DataFixtures;

use App\Entity\ItemAccessory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ItemAccessoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $itemAccessory = new ItemAccessory();
        $itemAccessory->setBasket($this->getReference('item_0'));
        $itemAccessory->setAccessory($this->getReference('accessory_0'));
        $itemAccessory->setQuantity(1);
        $manager->persist($itemAccessory);

        $itemAccessory = new ItemAccessory();
        $itemAccessory->setBasket($this->getReference('item_1'));
        $itemAccessory->setAccessory($this->getReference('accessory_1'));
        $itemAccessory->setQuantity(1);
        $manager->persist($itemAccessory);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BasketFixtures::class,
        ];
    }
}
