<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class CarDetailController extends Controller
{
    public function show($id)
    {
        $car = Car::with(['images', 'condition', 'document'])->findOrFail($id);
        
        // Fetch similar cars
        $similarCars = Car::where('id', '!=', $id)
            ->where('status', 'Available')
            ->where('company', $car->company)
            ->take(3)
            ->get();

        return view('customer.car-details', compact('car', 'similarCars'));
    }

    public function storeEnquiry(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string',
        ]);

        $validated['car_id'] = $id;

        Enquiry::create($validated);

        return back()->with('success', 'Your enquiry has been received. We will contact you shortly regarding this car!');
    }
}
