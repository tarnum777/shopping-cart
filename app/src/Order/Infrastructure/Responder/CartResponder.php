<?php

namespace App\Order\Infrastructure\Responder;

use App\Order\Domain\Entity\Order;
use App\Order\Infrastructure\Form\CartType;
use App\Product\Infrastructure\Form\AddToCartType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class CartResponder
{
    public function __construct(
        private Environment          $twig,
        private FormFactoryInterface $formFactory
    )
    {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(Request $request, FormInterface $form, ?Order $order): Response
    {
        $form = $this->formFactory->create(CartType::class, $order);
        $form->handleRequest($request);
        return new Response($this->twig->render('Order/cart.html.twig', [
            'order' => $order,
            'form' => $form->createView()
        ]));
    }
}