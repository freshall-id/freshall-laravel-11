<?php

namespace App\Utils;

class Formatter
{
    public static function ToNumberFormat($price_total): string
    {
        return 'Rp ' . number_format($price_total, 2, ',', '.');
    }
}