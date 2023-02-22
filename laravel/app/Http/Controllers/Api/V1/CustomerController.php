<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\CustomersFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CustomerCollection
     */
    public function index(Request $request)
    {
        $filter = new CustomersFilter();
        $queryItems = $filter->transform($request); // [['column', 'operator', 'value']]
        if (count($queryItems) == 0) {
            return new CustomerCollection(Customer::paginate());
        } else {
            $customers = Customer::where($queryItems)->paginate();

            return new CustomerCollection($customers->appends($request->query()));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCustomerRequest $request
     * @return CustomerResource
     */
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @param $id
     * @return CustomerResource
     */
    public function show(Request $request, $id)
    {
        return new CustomerResource(Customer::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCustomerRequest $request
     * @param Customer $customer
     * @return Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoices)
    {
        //
    }
}
