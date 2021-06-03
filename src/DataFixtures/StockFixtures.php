<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Stock;

class StockFixtures extends Fixture implements DependentFixtureInterface
{
    public const NUMBER = 5;

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <  self::NUMBER; $i++) {
            $stock = new Stock();
            $stock->setCity($this->getReference('city_0'));
            $stock->setProduct($this->getReference('product_0'));
            $manager->persist($stock);
            $this->setReference('stock_' . $i, $stock);
        }

        for ($i = 0; $i < self::NUMBER; $i++) {
            $stock = new Stock();
            $stock->setCity($this->getReference('city_0'));
            $stock->setProduct($this->getReference('product_1'));
            $manager->persist($stock);
            $number = $i + self::NUMBER + 1;
            $this->setReference('stock_' . $number, $stock);
        }

        for ($i = 0; $i < self::NUMBER; $i++) {
            $stock = new Stock();
            $stock->setCity($this->getReference('city_0'));
            $stock->setAccessory($this->getReference('accessory_0'));
            $number = $i + self::NUMBER * 2 + 1;
            $manager->persist($stock);
            $this->setReference('stock_' . $number, $stock);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
            AccessoryFixtures::class,
            CityFixtures::class,
        ];
    }
}
