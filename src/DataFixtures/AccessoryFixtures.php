<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Accessory;

class AccessoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
         $accessory = new Accessory();
         $accessory->setName('cadre de poussette');
         $accessory->setIdentifier('cadre');
         $accessory->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor 
         fermentum nulla at pellentesque. Nam ultricies cursus lectus. Etiam venenatis fermentum tortor, 
         maximus mattis arcu faucibus vel. Pellentesque mi dui, suscipit fermentum sodales id, laoreet sit amet');
         $accessory->setPricePerDay(24);
         $accessory->setPriceService(15);
         $accessory->setArgumentOne('Légère et maniable');
         $accessory->setArgumentTwo('Dépliable à la main');
         $accessory->setArgumentThree('Harnais 5 points');
         $accessory->setCharacteristic('Ce porte-bébé s’utilise de la naissance jusqu’aux 20kg de bébé.');
         $accessory->setProduct($this->getReference('product_0'));
         $manager->persist($accessory);
         $this->setReference('accessory_0', $accessory);

        $accessory = new Accessory();
        $accessory->setName('nacelle de poussette');
        $accessory->setIdentifier('nacelle');
        $accessory->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor 
         fermentum nulla at pellentesque. Nam ultricies cursus lectus. Etiam venenatis fermentum tortor, 
         maximus mattis arcu faucibus vel. Pellentesque mi dui, suscipit fermentum sodales id, laoreet sit amet');
        $accessory->setPricePerDay(24);
        $accessory->setPriceService(15);
        $accessory->setArgumentOne('Légère et maniable');
        $accessory->setArgumentTwo('Dépliable à la main');
        $accessory->setArgumentThree('Harnais 5 points');
        $accessory->setCharacteristic('Ce porte-bébé s’utilise de la naissance jusqu’aux 20kg de bébé.');
        $accessory->setProduct($this->getReference('product_0'));
        $manager->persist($accessory);
        $this->setReference('accessory_1', $accessory);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}
