<?php

namespace App\Helpers;

use App\ENUM\CountryEnum;

class PhoneHelper
{
    public static function getCode($phone): string
    {
        preg_match('/\(\d+\)/', $phone, $matches);
        return '+' . trim($matches[0] ?? '', '()');
    }

    public static function getPhoneNumberOnly($phone): string
    {
        return explode(' ', $phone)[1] ?? '';
    }
}
