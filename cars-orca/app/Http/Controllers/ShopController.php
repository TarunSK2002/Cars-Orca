<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::where('status', 'Available')->with('images');

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('company', 'LIKE', "%{$search}%")
                  ->orWhere('model', 'LIKE', "%{$search}%")
                  ->orWhere('color', 'LIKE', "%{$search}%");
            });
        }

        // Filter by Company
        if ($request->filled('company')) {
            $query->where('company', $request->company);
        }

        // Filter by Fuel Type
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        // Filter by Transmission
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        // Filter by Price Range
        if ($request->filled('min_price')) {
            $query->where('total_price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('total_price', '<=', $request->max_price);
        }

        $cars = $query->orderBy('created_at', 'desc')->paginate(12);

        // Fetch all unique companies for filter dropdown
        $companies = Car::where('status', 'Available')->distinct()->pluck('company');

        return view('customer.shop', compact('cars', 'companies'));
    }
}
