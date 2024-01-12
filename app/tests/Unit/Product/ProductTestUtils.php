<?php

namespace App\Tests\Unit\Product;

use App\Order\Domain\Entity\Order;
use App\Product\Domain\Entity\Product;
use Doctrine\Persistence\ObjectManager;

trait ProductTestUtils
{
    public function __construct(private ObjectManager $manager)
    {
    }

    public function createTestProduct(?string $name, ?string $description, ?float $price): Product
    {
        $product = new Product();
        $product
            ->setName($name ?? 'Product ' . mt_rand(1, 100))
            ->setDescription($description ?? 'Lorem ipsum dolor sit amet.')
            ->setPrice($price ?? (mt_rand(1, 100) + mt_rand(1, 100) / 100));
        $this->manager->persist($product);
        $this->manager->flush();

        return $product;
    }
}