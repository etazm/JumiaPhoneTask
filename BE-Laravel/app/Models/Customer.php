<?php

namespace App\Models;

use App\ENUM\CountryEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [];

    protected $table = 'customer';


    public function scopePhoneValidity(Builder $query, $is_valid): Builder
    {
        if (is_null($is_valid)) {
            return $query;
        }
        return ($is_valid) ? $query->validPhone() : $query->invalidPhone();
    }

    public function scopeValidPhone(Builder $query): Builder
    {
        return $query->whereRaw("REGEXP('{$this->getPhonesRegex()}', `phone`)");
    }

    public function scopeInvalidPhone(Builder $query): Builder
    {
        return $query->whereRaw("NOT REGEXP('{$this->getPhonesRegex()}', `phone`)");
    }

    private function getPhonesRegex(): string
    {
        return '/' . implode('|', CountryEnum::listRegex()) . '/';
    }
}
