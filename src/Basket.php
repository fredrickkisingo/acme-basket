<?php

class Basket {
    private array $catalogue ;
    private array $deliveryRules ;
    private array $items = [];
    private array $offers = [];

    public function __construct(array $catalogue,array $deliveryRules,array  $items = [],$offers = [])
    {
        $this->catalogue = $catalogue;
        $this->deliveryRules = $deliveryRules;
        $this->items = $items;
        $this->offers = $offers;
    }
    public function add(string $productCode)
    {
        if(!isset($this->catalogue[$productCode])){
            throw new InvalidArgumentException("Product $productCode not found in catalogue");
        }
        return $this->items[] = $productCode;
    }

    public function total(){
        //Return total basket cost taking into acc delivery and offer rules
        $subtotal = $this->calculateSubTotal();
        $discount = $this->applyOffers();
        $delivery = $this->calculateDeliveryFee($subtotal-$discount);

        return round($subtotal+$delivery-$discount,2);
    }

    private function calculateSubTotal(){
        $subtotal = 0.0;
        foreach($this->items as $item){
            $subtotal += $this->catalogue[$item]['price'];
        }
        return $subtotal;
    }
    private function applyOffers(): float
    {
        //orders
        $discount = 0.0;
        $countRO1 = 0;
        foreach($this->items as $item){
            if($item === 'R01'){
                $countRO1++;
            }
        }
        // Initial offer, For every pair of R01, discount half of one (32.95 / 2)
        $pairs = intdiv($countRO1, 2);
        $discount += $pairs * $this->catalogue['R01']['price'] / 2;
        return $discount;
    }
    private function calculateDeliveryFee(float $afterDiscount){
        foreach($this->deliveryRules as $rule){
            if($afterDiscount >= $rule['threshold']){
                print_r("Delivery fee is $rule[cost]");
                return $rule['cost'];
            }
        }
        return 0.0;
    }
}
