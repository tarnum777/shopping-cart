<?php

namespace App\Order\Infrastructure;

use App\Order\Application\SessionStorageInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HttpSessionStorage implements SessionStorageInterface
{
    private RequestStack $requestStack;

    private const ORDER_KEY_NAME = 'order_id';

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function setOrderId(int $orderId): void
    {
        $this->getSession()->set(self::ORDER_KEY_NAME, $orderId);
    }

    public function getOrderId(): ?int
    {
        return $this->getSession()->get(self::ORDER_KEY_NAME);
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}