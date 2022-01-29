<?php

namespace App\Http\Requests;

use App\DTO\CustomerFilterDTO;
use App\ENUM\CountryEnum;
use Illuminate\Foundation\Http\FormRequest;

class CustomerFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'country' => 'nullable|in:' . implode(',', CountryEnum::listValues()),
            'is_valid' => 'nullable|boolean',
        ];
    }

    public function dto(): CustomerFilterDTO
    {
        return new CustomerFilterDTO($this->validated());
    }
}
