<?php

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/vendor/autoload.php';

use App\Models\ElectronicItems;
use App\Models\Console;
use App\Models\Television;
use App\Models\RemoteController;
use App\Models\Microwave;
use App\Models\WiredController;

const REMOTE_CONTROLLER_TYPE = 'remote';
const WIRED_CONTROLLER_TYPE = 'wired';

try {

    // Create Extras
    $remoteController = new RemoteController(1000);
    $wiredController = new WiredController(2000);

    // Prices are stored in cents
    // Add 1 console, 2 tv with different prices and 1 microwaves
    $consoleOne = new Console(
        49999,
        [
            $remoteController,
            $remoteController,
            $wiredController,
            $wiredController,
        ]
    );


    $tvOne = new Television(
        20000,
        [
            $remoteController,
            $remoteController,
        ]
    );

    $tvTwo = new Television(
        34999,
        [
            $remoteController,
        ]
    );

    $microwaveOne = new Microwave(12500);

    $personOneShoppingList = New ElectronicItems([
        $consoleOne,
        $tvOne,
        $tvTwo,
        $microwaveOne
    ]);

    $sortedItems = json_encode($personOneShoppingList->getSortedItems(), JSON_PRETTY_PRINT);
    $totalPrice = number_format($personOneShoppingList->getTotalPaid(), 2, ',');

    var_dump($sortedItems);
    echo "Total paid amount: $totalPrice";

} catch (\Exception $e) {
    echo "Error: {$e->getMessage()}";
}

