<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName('Le lit parapluie');
        $product->setIdentifier('litParapluie ');
        $product->setDescription("Pour assurer les nuits de bébé, sélectionnez le lit de voyage light de Babyjorn.");
        $product->setStorage('Bordeaux ');
        $product->setPrice(850.50);
        $product->setTarget(2);
        $product->setMarque('Babyjorn');
        $manager->persist($product);
        $manager->flush();
    }
}
