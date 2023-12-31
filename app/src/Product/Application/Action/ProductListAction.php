<?php

namespace App\Product\Application\Action;

use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Product\Infrastructure\Responder\ProductListResponder;
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
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;


    public function __construct(ProductListResponder $responder, ProductRepositoryInterface $productRepository)
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