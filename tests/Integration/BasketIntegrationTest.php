<?php

namespace Integration;

use Acme\Basket;
use Acme\BuyOneGetSecondOneHalfPrice;
use PHPUnit\Framework\TestCase;

class BasketIntegrationTest extends TestCase
{
    protected array $catalogues;
    protected array $deliveryRules;

    protected function setUp(): void{
        $this->catalogues = [
            'R01' => ['name' => 'Red Widget', 'price' => 32.95],
            'G01' => ['name' => 'Green Widget', 'price' => 24.95],
            'B01' => ['name' => 'Blue Widget', 'price' => 7.95],
        ];
        $this->deliveryRules = [
            ['threshold' => 90, 'cost' => 0.0],
            ['threshold' => 50, 'cost' => 2.95],
            ['threshold' => 0, 'cost' => 4.95],
        ];
    }

    public function test_basket_checkout_with_discount_and_delivery(): void
    {
        $offers =[
            new BuyOneGetSecondOneHalfPrice('R01')
        ];

        $basket = new Basket($this->catalogues, $this->deliveryRules, [], $offers);
        $basket->add('R01');
        $basket->add('G01');

        $total = $basket->total();

        $this->assertEquals(60.85, $total);
    }
}
