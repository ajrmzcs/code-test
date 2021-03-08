<?php

namespace App\Models;

use App\Contracts\ElectronicItemInterface;

abstract class ElectronicItem implements ElectronicItemInterface
{

    protected const ELECTRONIC_ITEM_CONSOLE = 'console';
    protected const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    protected const ELECTRONIC_ITEM_TELEVISION = 'television';
    protected const ELECTRONIC_ITEM_REMOTE_CONTROLLER = 'remote_controller';
    protected const ELECTRONIC_ITEM_WIRED_CONTROLLER = 'wired_controller';

    /**
     * @var float
     */
    public $price;

    /**
     * @var string
     */
    public $type;

    /**
     * @var array
     */
    public $extras = [];

    /**
     * @var string
     */
    public static $types = [
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE,
        self::ELECTRONIC_ITEM_TELEVISION,
        self::ELECTRONIC_ITEM_REMOTE_CONTROLLER,
        self::ELECTRONIC_ITEM_WIRED_CONTROLLER,
    ];


    public function __construct(float $price, array $extras, ?int $limit, string $type)
    {
        $this->setPrice($price);

        try {
            $this->handleExtras($extras, $limit);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $this->setType($type);
    }

    /**
     * Get the item price
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set item price
     *
     * @param float $price
     * @return $this
     */
    function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get the item type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set item type
     *
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Check if a new extra can be added to the item
     *
     * @param int|null $limit
     * @return bool
     */
    public function maxExtras(?int $limit): bool
    {
        if (is_null($limit)) {
            return true;
        }

        if (count($this->extras) < $limit) {
            return true;
        }
        return false;
    }

    /**
     * Get the item extras
     *
     * @return array
     */
    public function getExtras(): array
    {
        return $this->extras;
    }

    /**
     * Set item extras
     *
     * @param ElectronicItem $electronicItem
     * @return $this
     */
    public function setExtra(ElectronicItem $electronicItem): self
    {
        $this->extras[] = $electronicItem;
        return $this;
    }

    /**
     * Add extras to an item
     *
     * @param array $extras
     * @param int|null $limit
     * @throws \Exception
     */
    public function handleExtras(array $extras, ?int $limit): void
    {
        foreach ($extras as $extra) {

            if ($this->maxExtras($limit)) {
                $this->setExtra($extra);
            } else {
                throw new \Exception(
                    'You cannot add more than '
                    . $limit
                    . ' extras to this electronic item'
                );
            }

        }
    }
}
