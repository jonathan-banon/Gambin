<?php

namespace App\DataFixtures;

use App\Entity\ItemProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ItemProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $itemProduct = new ItemProduct();
        $itemProduct->setQuantity(2);
        $itemProduct->setProduct($this->getReference('product_0'));
        $itemProduct->setBasket($this->getReference('item_0'));
        $manager->persist($itemProduct);

        $itemProduct = new ItemProduct();
        $itemProduct->setQuantity(1);
        $itemProduct->setProduct($this->getReference('product_1'));
        $itemProduct->setBasket($this->getReference('item_1'));
        $manager->persist($itemProduct);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
            BasketFixtures::class,
        ];
    }
}
