<?php

namespace App\Models\Static;

class PaymentMethod 
{
    public static $payment_methods = [
        [
            'id' => 1,
            'name' => 'Bank Transfer',
            'guidelines' => 'Transfer to BCA 1234567890 a/n PT. Toko Online',
            'image' => 'freshall/app/bca.png',
        ],
        [
            'id' => 2,
            'name' => 'QRIS',
            'guidelines' => 'Scan the QRIS code',
            'image' => 'freshall/app/qris.png',
        ]
    ];  

    public static function getPaymentMethodById($id)
    {
        foreach (self::$payment_methods as $payment_method) {
            if ($payment_method['id'] == $id) {
                return $payment_method;
            }
        }

        return null;
    }
}
