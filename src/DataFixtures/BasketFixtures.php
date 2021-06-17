<?php

namespace App\DataFixtures;

use App\Entity\Basket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BasketFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $basket = new Basket();
        $basket->setUser($this->getReference('user_0'));
        $manager->persist($basket);
        $this->setReference('basket_0', $basket);

        $basket = new Basket();
        $basket->setUser($this->getReference('user_1'));
        $manager->persist($basket);
        $this->setReference('basket_1', $basket);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
