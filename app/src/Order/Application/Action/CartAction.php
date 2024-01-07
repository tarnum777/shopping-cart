<?php

namespace App\Order\Application\Action;

use App\Order\Application\Service\OrderProcessorInterface;
use App\Order\Infrastructure\Form\CartType;
use App\Order\Infrastructure\Responder\CartResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartAction
{
    public function __construct(
        private CartResponder  $responder,
        private FormFactoryInterface    $formFactory,
        private OrderProcessorInterface $orderProcessor,
    )
    {
    }

    #[Route('/cart', name: 'cart')]
    public function __invoke(Request $request): Response
    {
        $order = $this->orderProcessor->getSessionOrder();

        $form = $this->formFactory->create(CartType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order->setUpdatedAt(new \DateTime());
            $this->orderProcessor->saveOrder($order);

//            return $this->redirectToRoute('cart');
        }

        $responder = $this->responder;
        return $responder($request, $form, $order);
    }
}