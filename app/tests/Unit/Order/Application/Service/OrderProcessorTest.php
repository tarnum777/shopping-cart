<?php

namespace App\Tests\Unit\Order\Application\Service;

use App\Order\Application\Service\OrderProcessor;
use App\Order\Domain\Entity\Order;
use App\Order\Domain\Factory\OrderFactory;
use App\Order\Infrastructure\HttpSessionStorage;
use App\Order\Infrastructure\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrderProcessorTest extends KernelTestCase
{
    /**
     * @covers \App\Order\Application\Service\OrderProcessor::getSessionOrder
     */
    public function testReturnsNullWhenNoOrderInSession()
    {
        $sessionStorage = $this->createMock(HttpSessionStorage::class);
        $sessionStorage->expects(self::once())
            ->method('getOrderId')
            ->willReturn(null);
        $orderFactory = $this->createMock(OrderFactory::class);
        $orderRepository = $this->createMock(OrderRepository::class);

        $orderProcessor = new OrderProcessor(
            $sessionStorage, $orderFactory, $orderRepository
        );
        $this->assertNull($orderProcessor->getSessionOrder());
    }

    /**
     * @covers \App\Order\Application\Service\OrderProcessor::getSessionOrder
     */
    public function testReturnsOrderWhenOrderInSession()
    {
        $sessionStorage = $this->createMock(HttpSessionStorage::class);
        $sessionStorage->expects(self::once())
            ->method('getOrderId')
            ->willReturn(1);
        $orderFactory = $this->createMock(OrderFactory::class);
        $orderRepository = $this->createMock(OrderRepository::class);
        $orderRepository->expects(self::once())
            ->method('findOneBy')
            ->with(['id' => 1])
            ->willReturn($this->createMock(Order::class));

        $orderProcessor = new OrderProcessor(
            $sessionStorage, $orderFactory, $orderRepository
        );
        $this->assertNotNull($orderProcessor->getSessionOrder());
    }

    /**
     * @covers \App\Order\Application\Service\OrderProcessor::createOrder
     */
    public function testCreateOrderReturnsOrderInCartStatus()
    {
        $sessionStorage = $this->createMock(HttpSessionStorage::class);
        $orderFactory = $this->createMock(OrderFactory::class);
        $orderRepository = $this->createMock(OrderRepository::class);

        $orderProcessor = new OrderProcessor(
            $sessionStorage, $orderFactory, $orderRepository
        );
        $this->assertInstanceOf(Order::class, $orderProcessor->createOrder());
        $this->assertEquals(Order::STATUS_SHOPPING_CART, $orderProcessor->createOrder()->getStatus());
    }
}