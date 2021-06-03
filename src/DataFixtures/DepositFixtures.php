<?php

namespace App\DataFixtures;

use App\Entity\Deposit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepositFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $deposit = new Deposit();
        $deposit->setName('Gare de Bordeaux');
        $deposit->setIdentifier('bordeauxrailway');
        $deposit->setAddress('Rue Charles Domercq, Bordeaux');
        $deposit->setPostalCode('33800');
        $manager->persist($deposit);
        $this->setReference('deposit_0', $deposit);

        $deposit = new Deposit();
        $deposit->setName('Aéroport de Bordeaux');
        $deposit->setIdentifier('bordeauxairport');
        $deposit->setAddress('Mérignac');
        $deposit->setPostalCode('33700');
        $manager->persist($deposit);
        $this->setReference('deposit_1', $deposit);


        $deposit = new Deposit();
        $deposit->setName('InterContinental Bordeaux');
        $deposit->setIdentifier('bordeauxhotel');
        $deposit->setAddress('2-5 Place de la Comédie, Bordeaux');
        $deposit->setPostalCode('33000');
        $manager->persist($deposit);
        $this->setReference('deposit_2', $deposit);

        $manager->flush();
    }
}
