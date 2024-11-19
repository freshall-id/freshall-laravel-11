<?php

namespace App\Models\Static;

class ShippingProvider 
{
    public static $shipping_providers = [
        [
            'id' => 1,
            'name' => 'JNE',
            'price' => 10000,
        ],
        [
            'id' => 2,
            'name' => 'J&T',
            'price' => 12000,
        ],
        [
            'id' => 3,
            'name' => 'POS',
            'price' => 15000,
        ]
    ];

    public static function getShippingProviderById($id)
    {
        foreach (self::$shipping_providers as $shipping_provider) {
            if ($shipping_provider['id'] == $id) {
                return $shipping_provider;
            }
        }

        return null;
    }
}
