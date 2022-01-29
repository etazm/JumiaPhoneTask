<?php

namespace App\ENUM;

trait BaseEnum
{
    public static function listValues(): array
    {
        return array_map(
            fn(self $enum) => $enum->value,
            self::cases()
        );
    }
}
