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
        $dateReturned->setDate(2021, 5, 25);
        $rent->setDateIn($dateIn);
        $rent->setDateOut($dateOut);
        $rent->setDateReturn($dateReturned);
        $rent->setStatus(0);

        $rent->setStock($this->getReference('stock_0'));
        $rent->setDeposit($this->getReference('deposit_0'));
        $rent->setUser($this->getReference('user_0'));

        $manager->persist($rent);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StockFixtures::class,
            DepositFixtures::class,
            UserFixtures::class,
        ];
    }
}
