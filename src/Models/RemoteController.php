<?php


namespace App\Models;

class RemoteController extends ElectronicItem
{
    protected const EXTRA_LIMIT = 0;

    public function __construct(float $price = 0.0, array $extras = [])
    {
        parent::__construct($price, $extras, self::EXTRA_LIMIT, self::ELECTRONIC_ITEM_REMOTE_CONTROLLER);
    }
}
