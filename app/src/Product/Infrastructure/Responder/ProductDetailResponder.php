<?php

namespace App\Product\Infrastructure\Responder;

use App\Product\Domain\Entity\Product;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ProductDetailResponder
{
    /**
     * @var Environment
     */
    private Environment $twig;
    /**
     * @var RequestStack
     */
    private RequestStack $request;

    public function __construct(Environment $twig, RequestStack $request)
    {

        $this->twig = $twig;
        $this->request = $request;
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(Product $product): Response
    {
        $response=  new Response($this->twig->render('Product/detail.html.twig', [
            'product' => $product
        ]));
        return $response;
    }
}