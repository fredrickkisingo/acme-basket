<?php

namespace Acme;

class BuyOneGetSecondOneHalfPrice {

    private string $productCode;
    public function __construct(string $productCode)
        {
            $this->productCode = $productCode;
        }

    public function apply(array $items):float{
        $discount = 0.0;
        $countRO1 = 0;
        foreach($items as $item){
            if($item === 'R01'){
                $countRO1++;
            }
        }
        // Initial offer, For every pair of R01, discount half of one (32.95 / 2)
        $pairs = intdiv($countRO1, 2);
        $discount += $pairs * (32.95 / 2);
        return $discount;
    }
}
