<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order_Item;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cashier.index');
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
        try {
            DB::beginTransaction();
            
            if (!$request->items || empty($request->items)) {
                return response()->json(['error' => 'No products selected.'], Response::HTTP_BAD_REQUEST);
            }
            
            // Calculate total amount
            $totalAmount = array_sum(array_map(function($product) {
                return $product['price'] * $product['quantity'];
            }, $request->items));
            
            // Check if user details exist
            $customer = null;
            if ($request->customer_first_name || $request->customer_middle_name || $request->customer_last_name || $request->customer_phone_number) {
                $customer = Customer::create([
                    'first_name' => $request->customer_first_name,
                    'middle_name' => $request->customer_middle_name,
                    'last_name' => $request->customer_last_name,
                    'phone' => $request->customer_phone_number,
                    'balance' => 0,
            ]);
    }
    
    $customer = Customer::findOrFail($customer ? $customer->id : $request->customer_id)->first();
    
    $validatedData = $request->validate([
            'cashier_id' => 'required|integer|exists:users,id',
            'items' => 'required|array|min:1',
            'total' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:cash,card',
        ]);
        
        // Create a new sale
        $sale = Sale::create([
            'user_id' => $validatedData['cashier_id'],
            'customer_id' => $customer->id, // You can modify this if needed
            'total_amount' => $validatedData['total'],
            'payment_method' => $validatedData['payment_method'],
            'status' => 'paid',
        ]);
        
        
        foreach($request->items as $item){
                $order_item = Order_Item::create([
                    'sale_id' => $sale['id'],
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
        }
        // @dd($request->items, $totalAmount, $request->all(), $customer, $sale);
    
    DB::commit();
            return response()->json([
                'data' => 'hello',
            ], Response::HTTP_OK);
    }
    catch(\Exception $ex){
            DB::rollBack();
            @dd($ex->getMessage());
    }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}