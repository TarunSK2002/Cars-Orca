<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars = \App\Models\Car::count();
        $availableCars = \App\Models\Car::where('status', 'Available')->count();
        $soldCars = \App\Models\Car::where('status', 'Sold')->count();
        $enquiriesCount = \App\Models\Enquiry::count();
        $recentEnquiries = \App\Models\Enquiry::with('car')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('totalCars', 'availableCars', 'soldCars', 'enquiriesCount', 'recentEnquiries'));
    }
}
