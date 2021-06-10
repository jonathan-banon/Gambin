<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $image = new Image();
        $image->setUrl('https://www.pepindepomme.com/42684-large_default/
        poussette-ultra-compacte-yoyo2-0-plus-6-plus-babyzen.jpg');
        $image->setProduct($this->getReference('product_0'));
        $manager->persist($image);

        $image = new Image();
        $image->setUrl('https://www.pepindepomme.com/42745-large_default/poussette-ultra-compacte-yoyo2
        -0-plus-6-plus-babyzen.jpg');
        $image->setProduct($this->getReference('product_0'));
        $manager->persist($image);

        $image = new Image();
        $image->setUrl('https://gambin.co/wp-content/uploads/2021/05/litparap-05.png');
        $image->setProduct($this->getReference('product_1'));
        $manager->persist($image);



        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            MarqueFixtures::class,
            PackFixtures::class,
            AccessoryFixtures::class,
            ProductFixtures::class,
        ];
    }
}
