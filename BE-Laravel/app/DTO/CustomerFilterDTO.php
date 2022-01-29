<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CustomerFilterDTO extends DataTransferObject
{
    public ?string $country;
    public ?bool $is_valid;

    public function __construct(array $parameters = [])
    {
        $parameters['is_valid'] = is_null($parameters['is_valid'] ?? null) ? null : boolval($parameters['is_valid']);
        parent::__construct($parameters);
    }
}
