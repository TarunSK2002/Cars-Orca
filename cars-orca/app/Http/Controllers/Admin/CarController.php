<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarCondition;
use App\Models\CarDocument;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year_of_manufacture' => 'nullable|string',
            'year_of_purchase' => 'nullable|string',
            'registration_number' => 'nullable|string',
            'owner_count' => 'nullable|string',
            'km_driven' => 'nullable|integer',
            'fuel_type' => 'nullable|string',
            'transmission' => 'nullable|string',
            'color' => 'nullable|string',
            'car_price' => 'required|numeric|min:0',
            'broker_amount' => 'required|numeric|min:0',
            'status' => 'required|in:Available,Sold',
            'purchase_date' => 'nullable|date',
            'sell_date' => 'nullable|date',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['total_price'] = $validated['car_price'] + $validated['broker_amount'];

        $car = Car::create($validated);

        // Save Condition
        CarCondition::create([
            'car_id' => $car->id,
            'engine_condition' => $request->engine_condition,
            'transmission_condition' => $request->transmission_condition,
            'body_condition' => $request->body_condition,
            'paint_condition' => $request->paint_condition,
            'interior_condition' => $request->interior_condition,
            'electrical_system' => $request->electrical_system,
            'tyre_condition' => $request->tyre_condition,
            'ac_condition' => $request->ac_condition,
            'brake_system' => $request->brake_system,
            'suspension_condition' => $request->suspension_condition,
            'overall_notes' => $request->overall_notes,
        ]);

        // Save Documents
        CarDocument::create([
            'car_id' => $car->id,
            'rc_book' => $request->rc_book,
            'insurance' => $request->insurance,
            'pollution_certificate' => $request->pollution_certificate,
            'loan_status' => $request->loan_status,
            'hypothecation' => $request->hypothecation,
            'status' => $request->doc_status ?? 'Pending',
        ]);

        // Save Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('cars', 'public');
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Car listing created successfully!');
    }

    public function edit($id)
    {
        $car = Car::with(['images', 'condition', 'document'])->findOrFail($id);
        return view('admin.cars.form', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year_of_manufacture' => 'nullable|string',
            'year_of_purchase' => 'nullable|string',
            'registration_number' => 'nullable|string',
            'owner_count' => 'nullable|string',
            'km_driven' => 'nullable|integer',
            'fuel_type' => 'nullable|string',
            'transmission' => 'nullable|string',
            'color' => 'nullable|string',
            'car_price' => 'required|numeric|min:0',
            'broker_amount' => 'required|numeric|min:0',
            'status' => 'required|in:Available,Sold',
            'purchase_date' => 'nullable|date',
            'sell_date' => 'nullable|date',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['total_price'] = $validated['car_price'] + $validated['broker_amount'];

        $car->update($validated);

        // Update Condition
        $car->condition()->updateOrCreate(
            ['car_id' => $car->id],
            [
                'engine_condition' => $request->engine_condition,
                'transmission_condition' => $request->transmission_condition,
                'body_condition' => $request->body_condition,
                'paint_condition' => $request->paint_condition,
                'interior_condition' => $request->interior_condition,
                'electrical_system' => $request->electrical_system,
                'tyre_condition' => $request->tyre_condition,
                'ac_condition' => $request->ac_condition,
                'brake_system' => $request->brake_system,
                'suspension_condition' => $request->suspension_condition,
                'overall_notes' => $request->overall_notes,
            ]
        );

        // Update Documents
        $car->document()->updateOrCreate(
            ['car_id' => $car->id],
            [
                'rc_book' => $request->rc_book,
                'insurance' => $request->insurance,
                'pollution_certificate' => $request->pollution_certificate,
                'loan_status' => $request->loan_status,
                'hypothecation' => $request->hypothecation,
                'status' => $request->doc_status ?? 'Pending',
            ]
        );

        // Handle deleted images (passed as an array of IDs to delete)
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $img = CarImage::find($imageId);
                if ($img) {
                    Storage::disk('public')->delete($img->image_path);
                    $img->delete();
                }
            }
        }

        // Save New Images
        if ($request->hasFile('images')) {
            $lastSort = $car->images()->max('sort_order') ?? -1;
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('cars', 'public');
                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                    'sort_order' => $lastSort + 1 + $index,
                ]);
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Car listing updated successfully!');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        // Delete images from storage
        foreach ($car->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', 'Car listing deleted successfully!');
    }
}
