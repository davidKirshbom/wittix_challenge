<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use Throwable;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customerService = new CustomerService();
        $customers = $customerService->all();
        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customerService = new CustomerService();
        try {
            $customer = $customerService->create($request->all());
            return response()->json($customer);
        } catch (Throwable $e) {
            return response($e->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $customerService = new CustomerService();
        try {
            $customer = $customerService->update($customer, $request->all());
            return response()->json($customer);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
        $customerService = new CustomerService();
        $customerService->delete($customer);
    }
}
