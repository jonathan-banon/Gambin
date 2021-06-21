<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public const CART = 'cart';

    public const PAYED = 'payed';

    public const IN_PROGRESS = 'in_progress';

    public const CLOSED = 'closed';

    public function load(ObjectManager $manager)
    {
        $status =  new Status();
        $status->setName(self::CART);
        $status->setIdentifier(self::CART);
        $manager->persist($status);
        $this->setReference('status_0', $status);

        $status =  new Status();
        $status->setName(self::PAYED);
        $status->setIdentifier(self::PAYED);
        $manager->persist($status);
        $this->setReference('status_1', $status);

        $status =  new Status();
        $status->setName(self::IN_PROGRESS);
        $status->setIdentifier(self::IN_PROGRESS);
        $manager->persist($status);
        $this->setReference('status_2', $status);

        $status =  new Status();
        $status->setName(self::CLOSED);
        $status->setIdentifier(self::CLOSED);
        $manager->persist($status);
        $this->setReference('status_3', $status);

        $manager->flush();
    }
}
