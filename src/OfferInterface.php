<?php
namespace Acme;

interface OfferInterface {
    /**
     * @param array $items  List of product codes in the basket
     */

    public function apply(array $items,array $catalogue):float;
}
