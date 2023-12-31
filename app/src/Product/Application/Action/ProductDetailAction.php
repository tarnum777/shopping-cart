<?php

namespace App\Product\Application\Action;

use App\Product\Domain\Entity\Product;
use App\Product\Infrastructure\Repository\ProductRepository;
use App\Product\Infrastructure\Responder\ProductDetailResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductDetailAction
{
    /**
     * @var ProductDetailResponder
     */
    private ProductDetailResponder $responder;
    /**
     * @var ProductRepository
     */
    private ProductRepository $productRepository;


    public function __construct(ProductDetailResponder $responder, ProductRepository $productRepository)
    {
        $this->responder = $responder;
        $this->productRepository = $productRepository;
    }

    #[Route('/product/{id}', name: 'product.detail')]
    public function __invoke(Product $product): Response
    {
        $responder = $this->responder;
        return $responder($product);
    }
}