<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Car;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    private function getSessionId()
    {
        if (!session()->has('guest_wishlist_id')) {
            session()->put('guest_wishlist_id', uniqid('guest_', true));
        }
        return session()->get('guest_wishlist_id');
    }

    public function index()
    {
        $sessionId = $this->getSessionId();
        $wishlistItems = Wishlist::where('session_id', $sessionId)
            ->with(['car.images'])
            ->get();

        return view('customer.wishlist', compact('wishlistItems'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
        ]);

        $sessionId = $this->getSessionId();

        Wishlist::firstOrCreate([
            'car_id' => $request->car_id,
            'session_id' => $sessionId,
        ]);

        return back()->with('success', 'Car added to your wishlist!');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
        ]);

        $sessionId = $this->getSessionId();

        Wishlist::where('car_id', $request->car_id)
            ->where('session_id', $sessionId)
            ->delete();

        return back()->with('success', 'Car removed from wishlist!');
    }
}
