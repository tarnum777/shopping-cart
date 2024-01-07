<?php

namespace App\Order\Application;

interface SessionStorageInterface
{
    public function getOrderId(): ?int;

    public function setOrderId(int $orderId): void;
}