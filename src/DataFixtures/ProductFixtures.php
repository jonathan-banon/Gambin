<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName('La poussette Yoyo');
        $product->setIdentifier('pousette');
        $product->setDescription("La poussette Yoyo est la poussette idéale pour arpenter les pavais 
        bordelais comme les quais le long de la garonne. Très légère, elle se déplie facilement d’une main.");
        $product->setStorage('Bordeaux ');
        $product->setPricePerDay(24);
        $product->setPriceService(15);
        $product->setArgumentOne('Légère et maniable');
        $product->setArgumentTwo('Dépliable à la main');
        $product->setArgumentThree('Harnais 5 points');
        $product->setCharacteristic('Ce porte-bébé s’utilise de la naissance jusqu’aux 20kg de bébé.');
        $product->setTarget(2);
        $product->setMarque($this->getReference('marque_0'));
        $product->addCategory($this->getReference('category_0'));
        $manager->persist($product);
        $this->addReference('product_0', $product);


        $product = new Product();
        $product->setName('Le lit parapluie');
        $product->setIdentifier('bed');
        $product->setDescription("Pour assurer les nuits de bébé, nous avons sélectionné le lit de voyage 
        light de Babyjorn. Très prisé des parents pour l’épaisseur de son matelas ainsi que pour sa légèreté
        (seulement 6kg). Récupérez cet équipement dès votre arrivée à destination ou demandez une livraison
         directement à votre hébergement. Notre livreur vous explique comment elle se règle. Idéal dès la naissance.");
        $product->setStorage('Bordeaux ');
        $product->setPricePerDay(24);
        $product->setPriceService(15);
        $product->setArgumentOne('Légère et maniable');
        $product->setArgumentTwo('Dépliable à la main');
        $product->setArgumentThree('Harnais 5 points');
        $product->setCharacteristic('Ce porte-bébé s’utilise de la naissance jusqu’aux 20kg de bébé.');
        $product->setTarget(3);
        $product->setMarque($this->getReference('marque_1'));
        $product->addCategory($this->getReference('category_0'));
        $manager->persist($product);
        $this->addReference('product_1', $product);


        $product = new Product();
        $product->setName('Le transat bébé');
        $product->setIdentifier('transat');
        $product->setDescription("Pour le repas ou pour se reposer, vous avez l’habitude de mettre bébé
         dans un transat ? Notre transat bébé de la marque Babyjorn devrait vous satisfaire. Idéal dès la naissance
          et jusqu’à 2 ans. ");
        $product->setStorage('Bordeaux ');
        $product->setPricePerDay(24);
        $product->setPriceService(15);
        $product->setArgumentOne('Légère et maniable');
        $product->setArgumentTwo('Dépliable à la main');
        $product->setArgumentThree('Harnais 5 points');
        $product->setCharacteristic('Ce porte-bébé s’utilise de la naissance jusqu’aux 20kg de bébé.');
        $product->setTarget(2);
        $product->setMarque($this->getReference('marque_1'));
        $product->addCategory($this->getReference('category_0'));
        $manager->persist($product);
        $this->addReference('product_2', $product);

        $product = new Product();
        $product->setName('Le porte-bébé');
        $product->setIdentifier('carrybaby');
        $product->setDescription("Pour flâner en ville tout en portant bébé dans la position la 
        plus confortable pour son développement. Ce porte-bébé s’utilise de la naissance jusqu’aux 20kg de bébé.");
        $product->setStorage('Bordeaux ');
        $product->setPricePerDay(24);
        $product->setPriceService(15);
        $product->setArgumentOne('Légère et maniable');
        $product->setArgumentTwo('Dépliable à la main');
        $product->setArgumentThree('Harnais 5 points');
        $product->setCharacteristic('Ce porte-bébé s’utilise de la naissance jusqu’aux 20kg de bébé.');
        $product->setTarget(2);
        $product->setMarque($this->getReference('marque_2'));
        $product->addCategory($this->getReference('category_0'));
        $manager->persist($product);
        $this->addReference('product_3', $product);


        $product = new Product();
        $product->setName('La chaise haute');
        $product->setIdentifier('carrybaby');
        $product->setDescription("Pour assurer les repas avec bébé, nous avons sélectionné la chaise
         haute de la marque Stokke. On adore son design et sa simplicité d’utilisation. Récupérez cet équipement
          dès votre arrivée à destination ou demandez une livraison directement à votre hébergement. Notre livreur 
          vous explique comment elle se règle.");
        $product->setStorage('Bordeaux ');
        $product->setPricePerDay(24);
        $product->setPriceService(15);
        $product->setArgumentOne('Légère et maniable');
        $product->setArgumentTwo('Dépliable à la main');
        $product->setArgumentThree('Harnais 5 points');
        $product->setCharacteristic('Ce porte-bébé s’utilise de la naissance jusqu’aux 20kg de bébé.');
        $product->setTarget(2);
        $product->setMarque($this->getReference('marque_3'));
        $product->addCategory($this->getReference('category_0'));
        $manager->persist($product);
        $this->addReference('product_4', $product);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            MarqueFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
