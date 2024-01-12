<?php

namespace App\Tests\Functional\Order\Application\Action;

use App\Tests\Functional\Order\Application\CartAssertionsTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

class CartActionTest extends WebTestCase
{
    use CartAssertionsTrait;

    public function testCartIsEmpty()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/cart');

        $this->assertResponseIsSuccessful();
        $this->assertCartIsEmpty($crawler);
    }

    public function testAddProductToCart()
    {
        $client = static::createClient();
        $product = $this->addRandomProductToCart($client);
        $crawler = $client->request('GET', '/cart');

        $this->assertResponseIsSuccessful();
        $this->assertCartItemsCountEquals($crawler, 1);
        $this->assertCartContainsProductWithQuantity($crawler, $product['name'], 1);
        $this->assertCartTotalEquals($crawler, $product['price']);
    }

    private function getRandomProduct(AbstractBrowser $client): array
    {
        $crawler = $client->request('GET', '/');
        $productNode = $crawler->filter('.card')->eq(rand(0, 9));
        $productName = $productNode->filter('.card-title')->getNode(0)->textContent;
        $productPrice = (float)$productNode->filter('span.h5')->getNode(0)->textContent;
        $productLink = $productNode->filter('.btn-dark')->link();

        return [
            'name' => $productName,
            'price' => $productPrice,
            'url' => $productLink->getUri()
        ];
    }

    private function addRandomProductToCart(AbstractBrowser $client, int $quantity = 1): array
    {
        $product = $this->getRandomProduct($client);

        $crawler = $client->request('GET', $product['url']);
        $form = $crawler->filter('form')->form();
        $form->setValues(['add_to_cart[quantity]' => $quantity]);

        $client->submit($form);

        return $product;
    }
}
