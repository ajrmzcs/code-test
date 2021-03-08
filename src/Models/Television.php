<?php


namespace App\Models;

class Television extends ElectronicItem
{
    protected const EXTRA_LIMIT = null;

    public function __construct(float $price, array $extras = [])
    {
        parent::__construct($price, $extras, self::EXTRA_LIMIT, self::ELECTRONIC_ITEM_TELEVISION);
    }
}
