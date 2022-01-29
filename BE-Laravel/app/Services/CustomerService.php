<?php

namespace App\Services;

use App\DTO\CustomerFilterDTO;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;

class CustomerService
{
    /**
     * @var Customer
     */
    private Customer $model;

    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }

    public function filter(CustomerFilterDTO $filterDTO)
    {
        $query = $this->query();
        if ($filterDTO->country) {
            $query->where('phone', 'like', '(' . $filterDTO->country . ')%');
        }

        return $query->phoneValidity($filterDTO->is_valid)->paginate();
    }

    public function query(): Builder
    {
        return $this->model->newQuery();
    }
}
