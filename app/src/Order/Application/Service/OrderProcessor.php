<?php

namespace App\Order\Application\Service;

use App\Order\Domain\Entity\Order;
use App\Order\Domain\Factory\OrderFactory;
use App\Order\Domain\Repository\OrderRepositoryInterface;

readonly class OrderProcessor implements OrderProcessorInterface
{
    public function __construct(
        private SessionStorageInterface  $orderSessionStorage,
        private OrderFactory             $orderFactory,
        private OrderRepositoryInterface $orderRepository,
    )
    {
    }

    public function getSessionOrder(): ?Order
    {
        $orderId = $this->orderSessionStorage->getOrderId();
        if (is_null($orderId)) {
            return null;
        } else {
            return $this->orderRepository->findOneBy([
                'id' => $orderId,
            ]);
        }
    }

    public function setSessionOrder(Order $order): void
    {
        $this->orderSessionStorage->setOrderId($order->getId());
    }

    public function createOrder(): Order
    {
        return $this->orderFactory->create();
    }

    public function saveOrder(Order $order): void
    {
        $order->setTotal($order->calculateTotal(true));
        $this->orderRepository->save($order);
    }
}