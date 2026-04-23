<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    /**
     * Display the homepage with featured vehicles.
     */
    public function home(): View
    {
        $vehicles = Vehicle::query()
            ->where('status', 'available')
            ->with('category', 'images')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $categories = Category::withCount('vehicles')->get();
        $totalVehicles = Vehicle::where('status', 'available')->count();
        $featuredVehicle = $vehicles->first();

        $testimonials = Testimonial::where('is_active', true)->latest()->get();

        return view('home', compact('vehicles', 'categories', 'totalVehicles', 'featuredVehicle', 'testimonials'));
    }

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

        // Get WhatsApp number from settings
        $whatsappNumber = Setting::getValue('contact_whatsapp', '');
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
     * Display the about page.
     */
    public function about(): View
    {
        $totalVehicles = Vehicle::where('status', 'available')->count();

        return view('about', compact('totalVehicles'));
    }

    /**
     * Display the contact page.
     */
    public function contact(): View
    {
        $contactSettings = [
            'office_address' => Setting::getValue('contact_office_address', 'Jl. Raya Utama No. 123, Jakarta, Indonesia 10110'),
            'whatsapp' => Setting::getValue('contact_whatsapp', '+62 812 3456 7890'),
            'email' => Setting::getValue('contact_email', 'info@driveease.com'),
            'hours_weekday' => Setting::getValue('contact_hours_weekday', 'Monday - Saturday: 08:00 - 20:00'),
            'hours_weekend' => Setting::getValue('contact_hours_weekend', 'Sunday: 09:00 - 17:00'),
        ];

        return view('contact', compact('contactSettings'));
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
