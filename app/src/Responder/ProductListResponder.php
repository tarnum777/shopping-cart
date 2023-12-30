<?php

namespace App\Responder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ProductListResponder
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
    public function __invoke(array $products): Response
    {
        $response=  new Response($this->twig->render('Product/list.html.twig', [
            'products' => $products
        ]));
        return $response;
    }
}