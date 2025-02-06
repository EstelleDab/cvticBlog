<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        {
            $category = new Category();
            $category->setName('Cvtic');
            $manager->persist($category);
    
            $this->addReference('cat-cvtic', $category);
    
            $category = new Category();
            $category->setName('Inspirational Quotes');
            $manager->persist($category);

            $this->addReference('cat-quotes', $category);
         

            $manager->flush();
    }
}
}