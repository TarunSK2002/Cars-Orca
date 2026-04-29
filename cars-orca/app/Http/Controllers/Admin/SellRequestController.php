<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellRequest;
use Illuminate\Http\Request;

class SellRequestController extends Controller
{
    public function index()
    {
        $sellRequests = SellRequest::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.sell-requests.index', compact('sellRequests'));
    }

    public function updateStatus(Request $request, $id)
    {
        $sellRequest = SellRequest::findOrFail($id);

        $request->validate([
            'status' => 'required|in:New,Contacted,Closed',
        ]);

        $sellRequest->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.sell-requests.index')->with('success', 'Sell request status updated successfully!');
    }
}
