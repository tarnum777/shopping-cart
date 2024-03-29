<?php

namespace App\Order\Domain\Factory;

use App\Order\Domain\Entity\Order;
use App\Order\Domain\Entity\OrderItem;
use App\Product\Domain\Entity\Product;

class OrderItemFactory
{
    public function create(Product $product, ?int $quantity = 1): OrderItem
    {
        $item = new OrderItem();
        $item->setProduct($product);
        $item->setQuantity($quantity);

        return $item;
    }
}