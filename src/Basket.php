<?php

class Basket {
    private array $catalogue ;

    public function __construct(array $catalogue)
    {
        $this->catalogue = $catalogue;
    }
    public function add(string $productCode)
    {
        if(!isset($this->catalogue[$productCode])){
            throw new InvalidArgumentException("Product $productCode not found in catalogue");
        }
        return $this->items[] = $productCode;
    }
}
