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
        $product->setDescription('Pour assurer les nuits de bébé, nous avons sélectionné le lit de voyage light de Babyjorn. Très prisé des parents pour l’épaisseur de son matelas ainsi que pour sa légèreté (seulement 6kg). Récupérez cet équipement dès votre arrivée à destination ou demandez une livraison directement à votre hébergement. Notre livreur vous explique comment elle se règle. Idéal dès la naissance.');
        $product->setStorage('Bordeaux ');
        $product->setPrice(850.50);
        $product->setTarget(2);
        $product->setMarque('Babyjorn');
        $manager->persist($product);
        $manager->flush();
    }
}
