<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    /**
     * Display the vehicle catalog with search and filters.
     */
    public function catalog(Request $request): View
    {
        $query = Vehicle::query()
            ->where('status', 'available')
            ->with('category', 'images')
            ->orderBy('created_at', 'desc');

        // Search by name or brand
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->whereBelongsTo(Category::find($request->input('category')));
        }

        // Filter by transmission
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->input('transmission'));
        }

        // Filter by price range
        if ($request->filled('price_min') || $request->filled('price_max')) {
            $minPrice = (int) $request->input('price_min', 0);
            $maxPrice = (int) $request->input('price_max', 10000000);

            $query->where(function ($q) use ($minPrice, $maxPrice) {
                $q->whereBetween('price_24h', [$minPrice, $maxPrice]);
            });
        }

        $vehicles = $query->paginate(12);
        $categories = Category::withCount('vehicles')->get();

        return view('catalog', compact('vehicles', 'categories'));
    }

    /**
     * Display the vehicle detail page.
     */
    public function show(Vehicle $vehicle): View
    {
        $vehicle->load('category', 'images');

        // Only show available vehicles
        if ($vehicle->status !== 'available') {
            abort(404);
        }

        // Get WhatsApp number from settings
        $whatsappNumber = Setting::getValue('whatsapp_number', '');
        $whatsappUrl = $this->generateWhatsAppUrl($vehicle, $whatsappNumber);

        // Get related vehicles (same category, excluding current)
        $relatedVehicles = Vehicle::where('status', 'available')
            ->whereBelongsTo($vehicle->category)
            ->where('id', '!=', $vehicle->id)
            ->with('images')
            ->take(4)
            ->get();

        return view('vehicle-detail', compact('vehicle', 'whatsappUrl', 'relatedVehicles'));
    }

    /**
     * Generate WhatsApp booking URL with pre-filled message.
     */
    private function generateWhatsAppUrl(Vehicle $vehicle, string $whatsappNumber): string
    {
        if (empty($whatsappNumber)) {
            return '#';
        }

        // Format phone number (remove non-numeric characters and add country code if needed)
        $phoneNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);

        // If phone doesn't start with country code, assume Indonesia (62)
        if (! str_starts_with($phoneNumber, '62')) {
            $phoneNumber = '62'.ltrim($phoneNumber, '0');
        }

        // Create pre-filled message
        $message = $this->buildBookingMessage($vehicle);

        // Encode message for URL
        $encodedMessage = urlencode($message);

        // Return WhatsApp URL
        return "https://wa.me/{$phoneNumber}?text={$encodedMessage}";
    }

    /**
     * Build the booking message for WhatsApp.
     */
    private function buildBookingMessage(Vehicle $vehicle): string
    {
        $appName = config('app.name', 'Rental Kendaraan');

        return "Halo! Saya tertarik untuk menyewa kendaraan berikut:\n\n".
            "🚗 *{$vehicle->name}*\n".
            "Brand: {$vehicle->brand}\n".
            "Tahun: {$vehicle->year}\n".
            'Transmisi: '.ucfirst($vehicle->transmission)."\n".
            "Kapasitas: {$vehicle->capacity} penumpang\n\n".
            "💰 Harga:\n".
            '12 Jam: Rp '.number_format($vehicle->price_12h)."\n".
            '24 Jam: Rp '.number_format($vehicle->price_24h)."\n\n".
            "📅 Tanggal sewa: [Masukkan tanggal]\n".
            "⏰ Durasi: [12 jam / 24 jam]\n\n".
            "Mohon konfirmasi ketersediaan dan proses selanjutnya.\n".
            'Terima kasih!';
    }
}
