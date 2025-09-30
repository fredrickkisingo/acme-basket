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
    }

    /** @test */

    public function it_can_add_a_single_product_and_calculate_total_with_delivery()
    {
        $basket = new Basket($this->catalogue);

        $basket->add('B01');
        $basket->add('G01');

        $this->assertEquals(37.85, $basket->total());
    }
}
