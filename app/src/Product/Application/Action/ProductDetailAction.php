<?php

namespace App\Product\Application\Action;

use App\Order\Application\Service\OrderProcessorInterface;
use App\Product\Domain\Entity\Product;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Product\Infrastructure\Form\AddToCartType;
use App\Product\Infrastructure\Responder\ProductDetailResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductDetailAction
{
    public function __construct(
        private ProductDetailResponder     $responder,
        private ProductRepositoryInterface $productRepository,
        private FormFactoryInterface       $formFactory,
        private OrderProcessorInterface    $orderProcessor,
    )
    {
    }

    #[Route('/product/{id}', name: 'product.detail')]
    public function __invoke(Product $product, Request $request): Response
    {
        $form = $this->formFactory->create(AddToCartType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();
            $item->setProduct($product);

            $order = $this->orderProcessor->getSessionOrder();
            if (is_null($order)) {
                $order = $this->orderProcessor->createOrder();
            }
            $order->addItem($item)
                ->setUpdatedAt(new \DateTime());

            $this->orderProcessor->saveOrder($order);
            $this->orderProcessor->setSessionOrder($order);
            $request->getSession()->getFlashBag()->add('notice',
                sprintf('You have added %d of %s to your cart!', $item->getQuantity(), $product->getName())
            );
//            return $this->redirectToRoute('product.detail', ['id' => $product->getId()]);
        }

        $responder = $this->responder;
        return $responder($product);
    }
}