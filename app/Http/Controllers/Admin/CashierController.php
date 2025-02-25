<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashiers = User::whereRole('cashier')->get();
        $totalCashiers = User::whereRole('cashier')->count();

        return view('admin.cashiers.index', [
            'cashiers' => $cashiers,
            'totalCashiers' => $totalCashiers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cashiers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $new_cashier = $request->validate([
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "middle_name" => "nullable|string|max:255",
            "gender" => "required|in:male,female",
            "role" => "required|string|in:cashier,admin,user",
            "status" => "required|string|in:active,inactive",
            "date_of_birth" => "required|date|before:today",
            "username" => "required|string|unique:users,username|min:4|max:50",
            "email" => "required|email|unique:users,email|max:255",
            "password" => "required|string|min:8|confirmed",
        ]);

        User::create($new_cashier);

        return redirect()->route('cashiers.index')->with('success', 'Cashier created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $username)
    {
        $cashier = User::whereUsername($username)->firstOrFail();

        return view('admin.cashiers.show', ['cashier' => $cashier]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $username)
    {
        $cashier = User::whereUsername($username)->firstOrFail();

        return view('admin.cashiers.edit', ['cashier' => $cashier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $username)
    {

        // Find the user
        $cashier = User::whereUsername($username)->firstOrFail();

        // Validate the request
        $request->validate([
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "middle_name" => "nullable|string|max:255",
            "gender" => "required|in:male,female",
            "role" => "required|string|in:cashier,admin,user",
            "status" => "required|string|in:active,inactive",
            "date_of_birth" => "required|date|before:today",
            "username" => "required|string|min:4|max:50|unique:users,username," . $cashier->id,
            "email" => "required|email|unique:users,email," . $cashier->id,
        ]);

        $image_path = $cashier->image ?? null;

        if ($request->hasFile('image')) {
            if ($cashier->image) {
                Storage::disk('public')->delete($cashier->image);
            }
            $image_path = Storage::disk('public')->put('user_images', $request->image);
        }

        // Check if product exists
        if (!$cashier) {
            return back()->with('invalid', 'Cashier not found.');
        }

        // Update user
        $cashier->update([
            "image" => $image_path,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "middle_name" => $request->middle_name,
            "gender" => $request->gender,
            "role" => $request->role,
            "status" => $request->status,
            "date_of_birth" => $request->date_of_birth,
            "username" => $request->username,
            "email" => $request->email,
        ]);

        return redirect()->back()->with('update', 'Cashier updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}