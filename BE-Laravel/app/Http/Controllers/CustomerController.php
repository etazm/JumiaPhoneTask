<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerFilterRequest;
use App\Http\Resources\CustomerResourceCollection;
use App\Services\CustomerService;

class CustomerController extends Controller
{

    /**
     * @var CustomerService
     */
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Requests\CustomerFilterRequest $request
     * @return \App\Http\Resources\CustomerResourceCollection
     */
    public function index(CustomerFilterRequest $request): CustomerResourceCollection
    {
        $customers = $this->customerService->filter($request->dto());
        return new CustomerResourceCollection($customers);
    }
}
