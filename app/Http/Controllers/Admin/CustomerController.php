<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        $totalCustomers = Customer::count();

        return view('admin.customers.index', ['customers' => $customers, 'totalCustomers' => $totalCustomers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        // dd($customer);
        $customer = Customer::whereName($name)->firstOrFail();

        return view('admin.customers.show', ['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        // Validate input
        $request->validate([
            'amount' => 'required|numeric|min:0', // Ensure amount is valid
        ]);

        // Update the balance
        $customer->balance -= $request->amount;
        $customer->save();

        return redirect()->back()->with('update', 'Balance has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}