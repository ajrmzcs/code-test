<?php


namespace App\Models;



class Console extends ElectronicItem
{

    protected const EXTRA_LIMIT = 4;

    public function __construct(float $price, array $extras = [])
    {
        parent::__construct($price, $extras, self::EXTRA_LIMIT, self::ELECTRONIC_ITEM_CONSOLE);
    }
}
