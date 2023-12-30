<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $product = new Product();
            $product
                ->setName('Product ' . $i)
                ->setDescription('Lorem ipsum dolor sit amet.')
                ->setPrice(mt_rand(1, 100) + mt_rand(1, 100) / 100);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
