<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Basket.php';

class BasketTest extends TestCase
{
    protected $catalogue;

    protected function setUp(): void
    {
        $this->catalogue = [
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

    /** @test */

    public function it_can_add_a_single_product_and_calculate_total_with_delivery()
    {
        $basket = new Basket($this->catalogue,$this->deliveryRules);

        $basket->add('B01');
        $basket->add('G01');

        $this->assertEquals(37.85, $basket->total());
    }
    /** @test */
    public function it_applies_red_widget_offer_when_two_red_widgets_added(){
        $basket = new Basket($this->catalogue,$this->deliveryRules);
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(54.38, $basket->total());
    }
}
