<?php

use App\Models\Console;
use App\Models\ElectronicItems;
use App\Models\Television;
use PHPUnit\Framework\TestCase;

class BaseCase extends TestCase
{
    /**
     * @var array
     */
    public $electronicItems;


    public function setUp(): void
    {
        parent::setUp();

        $this->electronicItems = new ElectronicItems([
            new Television(2000),
            new Console(1000),
        ]);
    }
}
