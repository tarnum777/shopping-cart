<?php

namespace App\Order\Domain\Factory;

use App\Order\Domain\Entity\Order;

class OrderFactory
{
    public function create(): Order
    {
        $order = new Order();
        $order
            ->setStatus(Order::STATUS_SHOPPING_CART)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTime());

        return $order;
    }
}