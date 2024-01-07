<?php

namespace App\Order\Application\Service;

interface SessionStorageInterface
{
    public function getOrderId(): ?int;

    public function setOrderId(int $orderId): void;
}