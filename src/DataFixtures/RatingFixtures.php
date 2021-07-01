<?php

namespace App\DataFixtures;

use App\Entity\Rating;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RatingFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $rating = new Rating();
        $rating->setContent('Super Poussette !!!');
        $rating->setUser($this->getReference('user_0'));
        $rating->setProduct($this->getReference('product_0'));
        $rating->setMark(4.5);
        $rating->setIsValidated(false);
        $manager->persist($rating);

        $rating = new Rating();
        $rating->setContent('Incroyable !!!');
        $rating->setUser($this->getReference('user_1'));
        $rating->setProduct($this->getReference('product_0'));
        $rating->setMark(3.2);
        $rating->setIsValidated(false);
        $manager->persist($rating);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ProductFixtures::class,
        ];
    }
}
