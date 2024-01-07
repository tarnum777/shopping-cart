<?php

namespace App\Product\Infrastructure\Responder;

use App\Product\Domain\Entity\Product;
use App\Product\Infrastructure\Form\AddToCartType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ProductDetailResponder
{
    public function __construct(
        private Environment          $twig,
        private RequestStack         $request,
        private FormFactoryInterface $formFactory
    )
    {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(Product $product): Response
    {
        $form = $this->formFactory->create(AddToCartType::class);
        return new Response($this->twig->render('Product/detail.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]));
    }
}