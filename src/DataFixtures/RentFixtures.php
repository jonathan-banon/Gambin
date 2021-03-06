<?php

namespace App\DataFixtures;

use App\Entity\Rent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;
use DateTime;

class RentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $rent = new Rent();
        $dateIn = new DateTime();
        $dateOut = new DateTime();
        $dateReturned = new DateTime();
        $dateIn->setDate(2021, 5, 12);
        $dateOut->setDate(2021, 5, 25);
        $rent->setDateIn($dateIn);
        $rent->setDateOut($dateOut);
        $rent->setBasket($this->getReference('basket_0'));
        $rent->setStatus($this->getReference('status_3'));

        $rent->setDeposit($this->getReference('deposit_0'));
        $manager->persist($rent);
        $this->setReference('rent_0', $rent);


        $rent = new Rent();
        $dateIn = new DateTime();
        $dateOut = new DateTime();
        $dateReturned = new DateTime();
        $dateIn->setDate(2021, 4, 12);
        $dateOut->setDate(2021, 4, 25);
        $dateReturned->setDate(2021, 4, 25);
        $rent->setDateIn($dateIn);
        $rent->setDateOut($dateOut);
        $rent->setDateReturn($dateReturned);
        $rent->setBasket($this->getReference('basket_1'));
        $rent->setStatus($this->getReference('status_3'));

        $rent->setDeposit($this->getReference('deposit_0'));
        $manager->persist($rent);
        $this->setReference('rent_1', $rent);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            DepositFixtures::class,
            StatusFixtures::class,
            BasketFixtures::class,
        ];
    }
}
