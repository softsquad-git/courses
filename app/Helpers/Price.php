<?php

namespace App\Helpers;

class Price
{
    /**
     * @param float|int|null $price
     * @return int|null
     */
    public static function code(float|int|null $price): ?int
    {
        if (!$price) {
            return null;
        }
        return $price * 100;
    }

    /**
     * @param float|int|null $price
     * @return int|float
     */
    public static function decode(float|int|null $price): int|float
    {
        return $price / 100;
    }
}
