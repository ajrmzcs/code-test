<?php

namespace App\Contracts;

interface ElectronicItemInterface
{
    /**
     * Returns the items depending on the sorting type requested
     *
     *
     * @param int|null $limit
     * @return bool
     */
    public function maxExtras(?int $limit): bool;
}
