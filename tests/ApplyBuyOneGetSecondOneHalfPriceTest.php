<?php
use PHPUnit\Framework\TestCase;


class  ApplyBuyOneGetSecondOneHalfPriceTest extends TestCase
{
    //call on the catalogue and deliver rules
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

    public function testTwoRedWidgetApplyOffer(){
        $basket = new Basket($this->catalogues,$this->deliveryRules);
        $basket->add('R01');
        $basket->add('R01');

        $this->assertEquals(54.38, $basket->total());
    }

}
