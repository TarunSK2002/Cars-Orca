<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::with('car')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function updateStatus(Request $request, $id)
    {
        $enquiry = Enquiry::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:New,Contacted,Closed',
        ]);

        $enquiry->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry status updated successfully!');
    }
}
