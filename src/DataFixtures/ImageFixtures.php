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

        $image = new Image();
        $image->setUrl('https://gambin.co/wp-content/uploads/2021/05/transaat-05-1021x1024.png');
        $image->setProduct($this->getReference('product_2'));
        $manager->persist($image);

        $image = new Image();
        $image->setUrl('https://gambin.co/wp-content/uploads/2021/05/portebaby-05-1021x1024.png');
        $image->setProduct($this->getReference('product_3'));
        $manager->persist($image);

        $image = new Image();
        $image->setUrl('https://gambin.co/wp-content/uploads/2021/05/chaise_h-05-1021x1024.png');
        $image->setProduct($this->getReference('product_4'));
        $manager->persist($image);

        $image = new Image();
        $image->setUrl('https://www.lapoussettecompacte.com/4416-pdt_480/ombrelle-poussette-yoyo-babyzen.jpg');
        $image->setAccessory($this->getReference('accessory_0'));
        $manager->persist($image);

        $image = new Image();
        $image->setUrl('https://www.lapoussettecompacte.com/5194-pdt_480/nacelle-yoyo-babyzen.jpg');
        $image->setAccessory($this->getReference('accessory_1'));
        $manager->persist($image);

        $image = new Image();
        $image->setUrl('https://www.lapoussettecompacte.com/4925-pdt_980/moustiquaire-yoyo-nacelle.jpg');
        $image->setAccessory($this->getReference('accessory_2'));
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
