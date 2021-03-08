<?php


// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/BaseCase.php';

class ElectronicItemsTest extends BaseCase
{
    /** @test */
    public function it_sort_items() {

        $sortedPrices = array_column($this->electronicItems->getSortedItems(), 'price');
        $this->assertEquals([10,20], $sortedPrices);
    }

    /** @test */
    public function it_get_items_by_type() {
        $tvItems = $this->electronicItems->getItemsByType('television');
        $this->assertEquals('television', ($tvItems[0])->getType());
        $this->assertNotEquals('console', ($tvItems[0])->getType());
    }

    /** @test */
    public function it_calculates_total_purchase_amount() {
        $total = $this->electronicItems->getTotalPaid();
        $this->assertEquals(30, $total);
    }


}
