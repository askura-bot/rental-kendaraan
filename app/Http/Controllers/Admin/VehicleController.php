<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Category;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class VehicleController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     *
     * @return array<int|string, string|\Closure>
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth', only: ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'updateStatus', 'deleteImage']),
        ];
    }

    /**
     * Display a listing of vehicles with search and filters.
     */
    public function index(): View
    {
        $query = Vehicle::query()->with('category', 'images');

        if (request('search')) {
            $search = request('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('brand', 'like', "%{$search}%");
        }

        if (request('category')) {
            $query->where('category_id', request('category'));
        }

        if (request('status')) {
            $query->where('status', request('status'));
        }

        $vehicles = $query->paginate(12);
        $categories = Category::all();

        return view('admin.vehicles.index', compact('vehicles', 'categories'));
    }

    /**
     * Show the form for creating a new vehicle.
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('admin.vehicles.create', compact('categories'));
    }

    /**
     * Store a newly created vehicle in storage.
     */
    public function store(StoreVehicleRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('vehicles/thumbnails', 'public');
        }

        $vehicle = Vehicle::create($validated);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('vehicles/gallery', 'public');
                VehicleImage::create([
                    'vehicle_id' => $vehicle->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()
            ->route('admin.vehicles.show', $vehicle)
            ->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the specified vehicle.
     */
    public function show(Vehicle $vehicle): View
    {
        $vehicle->load('category', 'images');

        return view('admin.vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit(Vehicle $vehicle): View
    {
        $vehicle->load('category', 'images');
        $categories = Category::all();

        return view('admin.vehicles.edit', compact('vehicle', 'categories'));
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle): RedirectResponse
    {
        $validated = $request->validated();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            if ($vehicle->thumbnail) {
                Storage::disk('public')->delete($vehicle->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('vehicles/thumbnails', 'public');
        }

        $vehicle->update($validated);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('vehicles/gallery', 'public');
                VehicleImage::create([
                    'vehicle_id' => $vehicle->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()
            ->route('admin.vehicles.show', $vehicle)
            ->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        // Delete thumbnail
        if ($vehicle->thumbnail) {
            Storage::disk('public')->delete($vehicle->thumbnail);
        }

        // Delete gallery images
        $vehicle->images->each(function (VehicleImage $image) {
            Storage::disk('public')->delete($image->image_path);
        });

        $vehicle->delete();

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Vehicle deleted successfully.');
    }

    /**
     * Update vehicle status via AJAX.
     */
    public function updateStatus(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'status' => ['required', 'in:available,rented,maintenance'],
        ]);

        $vehicle->update(['status' => $request->input('status')]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'status' => $vehicle->status,
                'message' => 'Status updated successfully.',
            ]);
        }

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    /**
     * Delete a gallery image.
     */
    public function deleteImage(VehicleImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Image deleted.']);
        }

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
