<?php

namespace App\Models;

use PHPUnit\Util\Exception;

class ElectronicItems
{
    /**
     * @var array
     */
    private array $items = [];

    public function __construct(array $items)
    {
        // Validates that all items are electronic Items
        foreach($items as $index => $item) {
            if (! $item instanceof ElectronicItem) {
                $itemIndex = $index + 1;
                throw new Exception("Item {$itemIndex}, is invalid. Must be of type Electronic Item");
            }
        }

        $this->items = $items;
    }

    /**
     * Returns the items sorted by price
     *
     * @return array
     */
    public function getSortedItems(): array
    {
        $itemsList = [];
        foreach ($this->items as $item) {
            $itemsList[] = [
                'price' => $price = $item->getPrice() / 100,
                '$description' => 'Price: '. $price . ' CAD' . ', Item: ' . $item->getType()
            ];

            foreach ($item->getExtras() as $extra) {
                $itemsList[] = [
                    'price' => $extraPrice = $extra->getPrice() / 100,
                    '$description' => 'Price: '
                        . $extraPrice
                        . ' CAD'
                        . ', Item: '
                        . $extra->getType()
                        . ' ('
                        . $item->getType()
                        . ')'
                ];
            }
        }

        usort($itemsList, function($a, $b) {
            return $a['price'] - $b['price'];
        });

        return $itemsList;
    }

    /**
     * Returns the an array of items for a given type
     *
     * @var string $type
     * @return array
     */
    public function getItemsByType(string $type): array
    {
        $items = [];
        if (in_array($type, ElectronicItem::$types)) {
            $callback = function ($item) use ($type) {
                return $item->type == $type;
            };
            $items = array_filter($this->items, $callback);
        }

        return $items;
    }

    /**
     * Returns purchase total
     *
     * @return float
     */
    public function getTotalPaid(): float
    {
        return array_reduce($this->items, function  ($carry, $item) {
            $carry += $item->getPrice() / 100;
            return $carry;
        });
    }
}

