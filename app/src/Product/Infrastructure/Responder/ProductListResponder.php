<?php

namespace App\Product\Infrastructure\Responder;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ProductListResponder
{
    public function __construct(private Environment $twig, private RequestStack $request)
    {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(array $products): Response
    {
//        return new Response('<div>AAAAAAAA</div>');
        return new Response($this->twig->render('Product/list.html.twig', [
            'products' => $products
        ]));
    }
}