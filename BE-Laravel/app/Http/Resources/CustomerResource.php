<?php

namespace App\Http\Resources;

use App\ENUM\CountryEnum;
use App\Helpers\PhoneHelper;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $code = PhoneHelper::getCode($this->phone);
        $country = CountryEnum::tryFrom($code);
        $attributes = [
            'code' => $code,
            'country' => $country ? $country->name() : '',
            'phone' => PhoneHelper::getPhoneNumberOnly($this->phone),
            'state' => $country->is_valid_phone($this->phone) ? 'OK' : 'NOK'
        ];
        return array_merge(parent::toArray($request), $attributes);
    }
}
