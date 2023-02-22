<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\InvoicesFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BulkStoreInvoicesRequest;
use App\Http\Requests\V1\UpdateInvoicesRequest;
use App\Http\Resources\V1\InvoiceCollection;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return InvoiceCollection
     */
    public function index(Request $request)
    {
        $filter = new InvoicesFilter();
        $queryItems = $filter->transform($request); // [['column', 'operator', 'value']]
        if (count($queryItems) == 0) {
            return new InvoiceCollection(Invoice::paginate());
        } else {
            $invoices = Invoice::where($queryItems)->paginate();

            return new InvoiceCollection($invoices->appends($request->query()));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function bulkStore(BulkStoreInvoicesRequest $request) {
        $bulk = collect($request->all())->map(function ($arr, $key) {
            return Arr::except($arr, ['customerId', 'billedDate', 'paidDate']);
        });

        Invoice::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoices
     * @return array
     */
    public function show(Invoice $invoices, $id)
    {
//        return new InvoiceResource(Invoice::findOrFail($id));
        return [
            Customer::find($id),
            Customer::find($id)->invoices
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInvoicesRequest $request
     * @param  \App\Models\Invoice  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoicesRequest $request, Invoice $invoices)
    {
        //
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
