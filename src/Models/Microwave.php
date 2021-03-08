<?php


namespace App\Models;

class Microwave extends ElectronicItem
{
    protected const EXTRA_LIMIT = 0;

    public function __construct(float $price, array $extras = [])
    {
        parent::__construct($price, $extras, self::EXTRA_LIMIT, self::ELECTRONIC_ITEM_MICROWAVE);
    }
}
