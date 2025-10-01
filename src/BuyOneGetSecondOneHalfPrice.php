<?php

namespace Acme;

class BuyOneGetSecondOneHalfPrice implements OfferInterface {


    /**
     * @param string $productCode
     */
        private string $productCode;
        public function __construct(string $productCode)
            {
                $this->productCode = $productCode;
            }

    /**
     * @param array $items
     * @return float
     * Check how many products are in the basket and apply discount accordingly
     */
    public function apply(array $items,array $catalogue ):float{
        $discount = 0.0;
        $count = 0;
        foreach($items as $item){
            if($item ===  $this->productCode){
                $count ++;
            }
        }

        // Find product price from the injected catalogue
        if (!isset($catalogue[$this->productCode])) {
            return 0.0; // product not found → no discount
        }

        $price = (float) $catalogue[$this->productCode]['price'];
        $pairs = intdiv($count, 2);
        $discount += $pairs * $price / 2;
        return $discount;
    }
}
