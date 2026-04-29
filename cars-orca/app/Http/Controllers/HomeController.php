<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\ContactMessage;
use App\Models\SellRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCars = Car::where('status', 'Available')->with('images')->orderBy('created_at', 'desc')->take(4)->get();
        return view('customer.index', compact('featuredCars'));
    }

    public function about()
    {
        return view('customer.about');
    }

    public function contact()
    {
        return view('customer.contact');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function sellYourCar()
    {
        return view('customer.sell-your-car');
    }

    public function storeSellYourCar(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'car_details' => 'required|string',
            'message' => 'nullable|string',
        ]);

        SellRequest::create($validated);

        return back()->with('success', 'Your car details have been submitted successfully! We will contact you soon.');
    }
}
