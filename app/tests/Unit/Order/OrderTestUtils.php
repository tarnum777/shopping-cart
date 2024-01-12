<?php

namespace App\Tests\Unit\Order;

use App\Order\Domain\Entity\Order;
use App\Order\Domain\Factory\OrderFactory;
use App\Order\Domain\Factory\OrderItemFactory;
use App\Product\Domain\Entity\Product;
use App\Tests\Unit\Product\ProductTestUtils;
use Doctrine\Persistence\ObjectManager;

trait OrderTestUtils
{
    use ProductTestUtils;

    public function __construct(private ObjectManager $manager)
    {
    }

    public function createTestOrder(?Product $product, ?int $quantity = 1): Order
    {
        $orderItemFactory = new OrderItemFactory();
        $orderItem = $orderItemFactory->create($product ?? $this->createTestProduct(), $quantity);

        $orderFactory = new OrderFactory();
        $order = $orderFactory->create();
        $order->addItem($orderItem);
        $this->manager->persist($order);
        $this->manager->flush();

        return $order;
    }
}