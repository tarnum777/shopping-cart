<?php

namespace App\Order\Domain\Repository;

use App\Order\Domain\Entity\Order;

interface OrderRepositoryInterface
{
    public function findAll();
    public function findOneBy(array $criteria);
    public function save(Order $order): void;
}