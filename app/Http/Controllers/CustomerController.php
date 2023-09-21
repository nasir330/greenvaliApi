<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $data = Customer::orderBy('id', 'DESC')->get();
        return Inertia::render('Customer/List', [
            'customers' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Customer/Add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        $newCustomer = new Customer;
        $newCustomer->customer_name = $request->customer_name;
        $newCustomer->customer_phone = $request->customer_phone;
        $newCustomer->customer_address = $request->customer_address;
        $newCustomer->save();

        return Redirect::route('customers.index')->with(['status' => 'success', 'message' => 'Customer Created Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return Inertia::render('Customer/Edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $customer->update([
            'customer_name'     => $request->customer_name,
            'customer_phone'    => $request->customer_phone,
            'customer_address'  => $request->customer_address,
        ]);
        return Redirect::route('customers.index')->with(['status' => 'success', 'message' => 'Customer Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return Redirect::route('customers.index')->with(['status' => 'success', 'message' => 'Customer Deleted Successfully']);
    }
}
