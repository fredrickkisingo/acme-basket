<?php
require __DIR__ . '/../vendor/autoload.php';

use Acme\Basket;
use Acme\BuyOneGetSecondOneHalfPrice;

$catalogue = [
    'R01' => ['name' => 'Red Widget', 'price' => 32.95],
    'G01' => ['name' => 'Green Widget', 'price' => 24.95],
    'B01' => ['name' => 'Blue Widget', 'price' => 7.95],
];
$deliveryRules = [
    ['threshold' => 90, 'cost' => 0.0],
    ['threshold' => 50, 'cost' => 2.95],
    ['threshold' => 0, 'cost' => 4.95],
];
$offers = [
    new BuyOneGetSecondOneHalfPrice('R01'),
];

$baskets = [
    ['B01', 'G01'],
    ['R01', 'R01'],
    ['R01', 'G01'],
    ['B01', 'B01', 'R01', 'R01', 'R01'],
];


foreach ($baskets as $products) {
    $basket = new Basket($catalogue, $deliveryRules,[], $offers);
    foreach ($products as $p) {
        $basket->add($p);
    }
    echo implode(', ', $products) . " => " . $basket->total() . PHP_EOL;
}
