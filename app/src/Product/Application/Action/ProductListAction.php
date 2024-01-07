<?php

namespace App\Product\Application\Action;

use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Product\Infrastructure\Responder\ProductListResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

readonly class ProductListAction
{
    public function __construct(
        private ProductListResponder       $responder,
        private ProductRepositoryInterface $productRepository
    )
    {
    }

    #[Route('/', name: 'product.list')]
    public function __invoke(Request $request): Response
    {
        return new Response('<div>AAAAAAAA</div>');
        $products = $this->productRepository->findAll();
        $responder = $this->responder;
        return $responder($products);
    }
}