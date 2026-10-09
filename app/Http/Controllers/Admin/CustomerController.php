<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')
            ->latest()
            ->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        return view('admin.customers.show', compact('customer'));
    }
}