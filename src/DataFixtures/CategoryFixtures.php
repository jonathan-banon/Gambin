<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Ville');
        $category->setPack($this->getReference('pack_2'));
        $manager->persist($category);
        $this->setReference('category_0', $category);

        $category = new Category();
        $category->setName('Plage');
        $category->setPack($this->getReference('pack_1'));
        $manager->persist($category);
        $this->setReference('category_1', $category);

        $category = new Category();
        $category->setName('Nature');
        $category->setPack($this->getReference('pack_0'));
        $manager->persist($category);
        $this->setReference('category_2', $category);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PackFixtures::class,
        ];
    }
}
