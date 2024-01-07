<?php

namespace App\Order\Application;

use App\Order\Domain\Entity\Order;

interface OrderProcessorInterface
{
    public function getSessionOrder(): ?Order;

    public function setSessionOrder(Order $order): void;

    public function createOrder(): Order;

    public function saveOrder(Order $order): void;
}