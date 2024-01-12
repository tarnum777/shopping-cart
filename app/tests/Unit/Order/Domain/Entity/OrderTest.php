<?php

namespace App\Tests\Unit\Order\Domain\Entity;

use App\Tests\Unit\Order\OrderTestUtils;
use App\Tests\Unit\Product\ProductTestUtils;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrderTest extends KernelTestCase
{
    use OrderTestUtils, ProductTestUtils {
        OrderTestUtils::__construct insteadof ProductTestUtils;
    }

    /**
     * @covers \App\Order\Domain\Entity\Order::addItem
     */
    public function testAddSameProductIncreasesQuantityOrderItem()
    {
        $testOrder = $this->createTestOrder();
    }
}