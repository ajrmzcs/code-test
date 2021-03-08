<?php


// Autoload files using the Composer autoloader.
use App\Models\RemoteController;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/BaseCase.php';


class ElectronicItemTest extends BaseCase
{
    /** @test */
    public function it_handles__unlimited_extras()
    {
        $remote = new RemoteController(0);
        $tv = current(($this->electronicItems->getItemsByType('television')));

        $tv->handleExtras(
            [
                $remote,
                $remote,
                $remote,
                $remote,
            ],
            null
        );

        $this->assertCount(4, $tv->getExtras());
    }

    /** @test */
    public function it_handles__max_extras()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('You cannot add more than 2 extras to this electronic item');

        $remote = new RemoteController(0);
        $console = current(($this->electronicItems->getItemsByType('console')));

        $console->handleExtras(
            [
                $remote,
                $remote,
                $remote,
                $remote,
            ],
            2
        );
    }
}

