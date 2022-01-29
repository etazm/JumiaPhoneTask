<?php

namespace App\ENUM;

enum CountryEnum: string
{
    use BaseEnum;

    case CAMERON = '+237';
    case ETHIOPIA = '+251';
    case MOROCCO = '+212';
    case MOZAMBIQUE = '+258';
    case UGANDA = '+256';

    public function regex(): string
    {
        return match ($this) {
            self::CAMERON => '\(237\)\ ?[2368]\d{7,8}$',
            self::ETHIOPIA => '\(251\)\ ?[1-59]\d{8}$',
            self::MOROCCO => '\(212\)\ ?[5-9]\d{8}$',
            self::MOZAMBIQUE => '\(258\)\ ?[28]\d{7,8}$',
            self::UGANDA => '\(256\)\ ?\d{9}$',
        };
    }

    public function name(): string
    {
        return match ($this) {
            self::CAMERON => 'Cameroon',
            self::ETHIOPIA => 'Ethiopia',
            self::MOROCCO => 'Morocco',
            self::MOZAMBIQUE => 'Mozambique',
            self::UGANDA => 'Uganda',
        };
    }

    public function is_valid_phone($phone): bool|int
    {
        return preg_match("/{$this->regex()}/", $phone);
    }


    public static function listRegex(): array
    {
        return array_map(
            fn(self $enum) => $enum->regex(),
            self::cases()
        );
    }

    public static function listCollection(): array
    {
        return array_map(
            fn(self $enum) => [
                'name' => $enum->name(),
                'code' => $enum->value,
                'regex' => $enum->regex(),
            ],
            self::cases()
        );
    }
}
