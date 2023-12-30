<?php

namespace App\Action;

use App\Repository\ProductRepository;
use App\Responder\ProductListResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductListAction
{
    /**
     * @var ProductListResponder
     */
    private ProductListResponder $responder;
    /**
     * @var ProductRepository
     */
    private ProductRepository $productRepository;


    public function __construct(ProductListResponder $responder, ProductRepository $productRepository)
    {
        $this->responder = $responder;
        $this->productRepository = $productRepository;
    }

    #[Route('/', name: 'product.list')]
    public function __invoke(Request $request): Response
    {
        $products = $this->productRepository->findAll();
        $responder = $this->responder;
        return $responder($products);
    }
}