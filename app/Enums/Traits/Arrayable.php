<?php

namespace App\Enums\Traits;

trait Arrayable
{
    /**
     * Returns a list of enum values
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
