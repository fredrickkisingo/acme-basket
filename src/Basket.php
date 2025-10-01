<?php
namespace Acme;

class Basket {

    /**
     * @var array<string, array{price: float}>
     */
    private array $catalogue ;
    /**
     * @var array<int, array{threshold: float, cost: float}>
     */
    private array $deliveryRules ;

    private array $items;
    public array $offers;

    public function __construct(array $catalogue,array $deliveryRules,array  $items = [],$offers = [])
    {
        $this->catalogue = $catalogue;
        $this->deliveryRules = $deliveryRules;
        $this->items = $items;
        $this->offers = $offers;
    }

    /**
     * @param string $productCode
     * @return string
     */
    public function add(string $productCode): string
    {
        if(!isset($this->catalogue[$productCode])){
            throw new InvalidArgumentException("Product $productCode not found in catalogue");
        }
        return $this->items[] = $productCode;
    }

    /**
     * @return float
     */
    public function total(): float
    {
        //Return total basket cost taking into acc delivery and offer rules
        $subtotal = $this->calculateSubTotal();
        $discount = $this->applyOffers();
        $delivery = $this->calculateDeliveryFee($subtotal-$discount);

        return round($subtotal+$delivery-$discount,2);
    }

    /**
     * @return float|mixed
     */
    private function calculateSubTotal(){
        $subtotal = 0.0;
        foreach($this->items as $item){
            $subtotal += $this->catalogue[$item]['price'];
        }
        return $subtotal;
    }

    /**
     * @return float
     */
    private function applyOffers(): float
    {
        $discount = 0.0;
        foreach($this->offers as $offer){
            $discount += $offer->apply($this->items, $this->catalogue);

        }
        return $discount;
    }

    /**
     * @param float $afterDiscount
     * @return float|mixed
     */
    private function calculateDeliveryFee(float $afterDiscount){
        foreach($this->deliveryRules as $rule){
            if($afterDiscount >= $rule['threshold']){
                return $rule['cost'];
            }
        }
        return 0.0;
    }
}
