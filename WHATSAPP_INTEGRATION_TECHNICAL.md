# WhatsApp Booking Integration - Technical Details

## Overview

The WhatsApp booking system generates pre-filled conversation links that automatically open WhatsApp with a formatted booking request message. This provides a seamless user experience without requiring a separate booking form.

---

## URL Structure

### Basic Format
```
https://wa.me/{phoneNumber}?text={encodedMessage}
```

### Example
```
https://wa.me/62812345678?text=Halo%21%20Saya%20tertarik%20untuk%20menyewa%20kendaraan%20berikut%3A%0A%0A%F0%9F%9A%97%20*Toyota%20Avanza*%0ABrand%3A%20Toyota%0ATahun%3A%202023...
```

---

## Phone Number Formatting

### Process

1. **Remove Special Characters**
   ```php
   $phoneNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
   // Input: "+62 (812) 345-678" or "0812-345-678"
   // Output: "62812345678" or "0812345678"
   ```

2. **Handle Country Code**
   ```php
   if (!str_starts_with($phoneNumber, '62')) {
       $phoneNumber = '62' . ltrim($phoneNumber, '0');
   }
   // Input: "0812345678"  → Output: "62812345678"
   // Input: "62812345678" → Output: "62812345678" (unchanged)
   // Input: "812345678"   → Output: "62812345678"
   ```

### Valid Formats
```
Input Format          | Output
0812345678           | 62812345678
812345678            | 62812345678
62812345678          | 62812345678
+62812345678         | 62812345678
+62 (812) 345-678    | 62812345678
62-812-345-678       | 62812345678
```

---

## Message Building

### Template Structure

```php
private function buildBookingMessage(Vehicle $vehicle): string
{
    $appName = config('app.name', 'Rental Kendaraan');

    return "Halo! Saya tertarik untuk menyewa kendaraan berikut:\n\n" .
        "🚗 *{$vehicle->name}*\n" .
        "Brand: {$vehicle->brand}\n" .
        "Tahun: {$vehicle->year}\n" .
        "Transmisi: " . ucfirst($vehicle->transmission) . "\n" .
        "Kapasitas: {$vehicle->capacity} penumpang\n\n" .
        "💰 Harga:\n" .
        "12 Jam: Rp " . number_format($vehicle->price_12h) . "\n" .
        "24 Jam: Rp " . number_format($vehicle->price_24h) . "\n\n" .
        "📅 Tanggal sewa: [Masukkan tanggal]\n" .
        "⏰ Durasi: [12 jam / 24 jam]\n\n" .
        "Mohon konfirmasi ketersediaan dan proses selanjutnya.\n" .
        "Terima kasih!";
}
```

### Generated Message

```
Halo! Saya tertarik untuk menyewa kendaraan berikut:

🚗 *Toyota Avanza*
Brand: Toyota
Tahun: 2023
Transmisi: Automatic
Kapasitas: 7 penumpang

💰 Harga:
12 Jam: Rp 250,000
24 Jam: Rp 400,000

📅 Tanggal sewa: [Masukkan tanggal]
⏰ Durasi: [12 jam / 24 jam]

Mohon konfirmasi ketersediaan dan proses selanjutnya.
Terima kasih!
```

### Message Components

| Component | Format | Example |
|-----------|--------|---------|
| Greeting | Plain text | "Halo! Saya tertarik..." |
| Vehicle Name | Bold with emoji | "🚗 *Toyota Avanza*" |
| Details | Key: Value pairs | "Brand: Toyota" |
| Pricing | With currency & format | "Rp 250,000" |
| Customer Fill-in | Bracketed | "[Masukkan tanggal]" |
| Closing | Professional | "Terima kasih!" |

---

## URL Encoding

### Process

The message is URL-encoded using `urlencode()`:

```php
$encodedMessage = urlencode($message);
```

### Character Mapping

| Character | Encoded | Reason |
|-----------|---------|--------|
| Space | `%20` | URL separator |
| ! | `%21` | Special char |
| * | `%2A` | WhatsApp bold marker |
| \n | `%0A` | Line break |
| : | `%3A` | Special char |
| [ | `%5B` | Special char |
| ] | `%5D` | Special char |
| ( | `%28` | Special char |
| ) | `%29` | Special char |

### Example Encoding

```
Original:
"Halo! Saya tertarik untuk menyewa kendaraan berikut:"

Encoded:
"Halo%21%20Saya%20tertarik%20untuk%20menyewa%20kendaraan%20berikut%3A"
```

---

## Complete URL Generation

### Step-by-Step

```php
// Step 1: Get phone number
$whatsappNumber = '62812345678';

// Step 2: Get vehicle
$vehicle = Vehicle::find(1);

// Step 3: Build message
$message = "Halo! Saya tertarik untuk menyewa kendaraan berikut:\n\n" .
           "🚗 *{$vehicle->name}*\n" .
           "Brand: {$vehicle->brand}\n" .
           "Tahun: {$vehicle->year}\n" .
           "Transmisi: " . ucfirst($vehicle->transmission) . "\n" .
           "Kapasitas: {$vehicle->capacity} penumpang\n\n" .
           "💰 Harga:\n" .
           "12 Jam: Rp " . number_format($vehicle->price_12h) . "\n" .
           "24 Jam: Rp " . number_format($vehicle->price_24h) . "\n\n" .
           "📅 Tanggal sewa: [Masukkan tanggal]\n" .
           "⏰ Durasi: [12 jam / 24 jam]\n\n" .
           "Mohon konfirmasi ketersediaan dan proses selanjutnya.\n" .
           "Terima kasih!";

// Step 4: Encode message
$encodedMessage = urlencode($message);

// Step 5: Generate URL
$whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$encodedMessage}";

// Step 6: Return URL
return $whatsappUrl;
```

### Result

```
https://wa.me/62812345678?text=Halo%21%20Saya%20tertarik%20untuk%20menyewa%20kendaraan%20berikut%3A%0A%0A%F0%9F%9A%97%20%2AToyota%20Avanza%2A%0ABrand%3A%20Toyota%0ATahun%3A%202023%0ATransmisi%3A%20Automatic%0AKapasitas%3A%207%20penumpang%0A%0A%F0%9F%92%B0%20Harga%3A%0A12%20Jam%3A%20Rp%20250%2C000%0A24%20Jam%3A%20Rp%20400%2C000%0A%0A%F0%9F%93%85%20Tanggal%20sewa%3A%20%5BMasukkan%20tanggal%5D%0A%E2%8F%B0%20Durasi%3A%20%5B12%20jam%20%2F%2024%20jam%5D%0A%0AMohon%20konfirmasi%20ketersediaan%20dan%20proses%20selanjutnya.%0ATerma%20kasih%21
```

---

## Implementation in Controller

### Method

```php
/**
 * Generate WhatsApp booking URL with pre-filled message.
 */
private function generateWhatsAppUrl(Vehicle $vehicle, string $whatsappNumber): string
{
    if (empty($whatsappNumber)) {
        return '#';
    }

    // Format phone number
    $phoneNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);

    if (!str_starts_with($phoneNumber, '62')) {
        $phoneNumber = '62' . ltrim($phoneNumber, '0');
    }

    // Create message
    $message = $this->buildBookingMessage($vehicle);

    // Encode message
    $encodedMessage = urlencode($message);

    // Return URL
    return "https://wa.me/{$phoneNumber}?text={$encodedMessage}";
}

/**
 * Build the booking message for WhatsApp.
 */
private function buildBookingMessage(Vehicle $vehicle): string
{
    return "Halo! Saya tertarik untuk menyewa kendaraan berikut:\n\n" .
        "🚗 *{$vehicle->name}*\n" .
        "Brand: {$vehicle->brand}\n" .
        "Tahun: {$vehicle->year}\n" .
        "Transmisi: " . ucfirst($vehicle->transmission) . "\n" .
        "Kapasitas: {$vehicle->capacity} penumpang\n\n" .
        "💰 Harga:\n" .
        "12 Jam: Rp " . number_format($vehicle->price_12h) . "\n" .
        "24 Jam: Rp " . number_format($vehicle->price_24h) . "\n\n" .
        "📅 Tanggal sewa: [Masukkan tanggal]\n" .
        "⏰ Durasi: [12 jam / 24 jam]\n\n" .
        "Mohon konfirmasi ketersediaan dan proses selanjutnya.\n" .
        "Terima kasih!";
}
```

---

## Usage in Views

### Blade Template

```blade
<a
    href="{{ $whatsappUrl }}"
    target="_blank"
    rel="noopener noreferrer"
    class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg transition"
>
    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
        <!-- WhatsApp Icon SVG -->
    </svg>
    {{ __('Book via WhatsApp') }}
</a>
```

### Controller Passing

```php
public function show(Vehicle $vehicle): View
{
    $vehicle->load('category', 'images');

    if ($vehicle->status !== 'available') {
        abort(404);
    }

    $whatsappNumber = Setting::getValue('whatsapp_number', '');
    $whatsappUrl = $this->generateWhatsAppUrl($vehicle, $whatsappNumber);

    return view('vehicle-detail', compact('vehicle', 'whatsappUrl'));
}
```

---

## Error Handling

### Missing WhatsApp Number

```php
if (empty($whatsappNumber)) {
    return '#';
}
```

Result: Button still displays but href is just `#` (no action)

### Alternative - Hide Button

```php
@if($whatsappNumber)
    <a href="{{ $whatsappUrl }}" target="_blank">
        {{ __('Book via WhatsApp') }}
    </a>
@else
    <p class="text-gray-500">{{ __('Booking not available') }}</p>
@endif
```

---

## Testing

### Unit Test Example

```php
public function test_generate_whatsapp_url()
{
    $vehicle = Vehicle::factory()->create([
        'name' => 'Toyota Avanza',
        'brand' => 'Toyota',
        'year' => 2023,
        'transmission' => 'automatic',
        'price_12h' => 250000,
        'price_24h' => 400000,
    ]);

    $controller = new VehicleController();
    $url = $controller->generateWhatsAppUrl(
        $vehicle,
        '62812345678'
    );

    $this->assertStringStartsWith('https://wa.me/62812345678?text=', $url);
    $this->assertStringContainsString('Toyota%20Avanza', $url);
    $this->assertStringContainsString('250%2C000', $url);
}
```

### Manual Test

1. Get a vehicle ID
2. Visit: `http://localhost:8000/vehicles/{id}`
3. Right-click "Book via WhatsApp" button
4. Select "Inspect" or "View Page Source"
5. Find the `href` attribute
6. Copy and paste in browser to test

---

## Customization

### Change Message Format

Modify `buildBookingMessage()` method:

```php
private function buildBookingMessage(Vehicle $vehicle): string
{
    // Your custom message format
    return "Custom greeting...\n" .
           "Custom details format...\n" .
           "Custom closing...";
}
```

### Add More Details

```php
private function buildBookingMessage(Vehicle $vehicle): string
{
    return "... existing message ...\n\n" .
        "📍 Lokasi Pengambilan: [Masukkan lokasi]\n" .
        "🏠 Lokasi Pengembalian: [Masukkan lokasi]\n" .
        "👤 Nama Lengkap: [Masukkan nama]\n" .
        "📱 Nomor Telepon: [Masukkan nomor]";
}
```

### Change Phone Number Prefix

```php
// For Indonesia (current)
if (!str_starts_with($phoneNumber, '62')) {
    $phoneNumber = '62' . ltrim($phoneNumber, '0');
}

// For other countries (example: Thailand 66)
if (!str_starts_with($phoneNumber, '66')) {
    $phoneNumber = '66' . ltrim($phoneNumber, '0');
}
```

---

## Limits & Considerations

### URL Length
- WhatsApp URLs have a practical limit
- Current implementation stays well under limits
- Typical message: ~1200-1500 characters
- URL encoding can add ~30% length

### Character Support
- Emojis work and transmit correctly ✅
- Special WhatsApp formatting (bold, italic) works ✅
- Line breaks work correctly ✅
- Unicode characters supported ✅

### Browser Compatibility
- Works on all modern browsers
- Desktop WhatsApp required for desktop browser
- Mobile: Opens WhatsApp app automatically
- WhatsApp Web: Opens if app not installed

---

## Security Considerations

### Phone Number Validation
- Currently accepts any format and tries to format
- Consider adding validation: `^[0-9+\-\s()]*$`

### Message Content
- Currently includes formatted prices from database
- Malicious input would need to modify vehicles (protected by authorization)
- Message is user-displayable, no sensitive data

### URL Security
- Uses HTTPS protocol (`https://wa.me/`)
- Opens in new tab (`target="_blank"`)
- Uses `rel="noopener noreferrer"` to prevent origin leak

---

## Future Enhancements

1. **Template Customization** - Admin panel to edit message template
2. **Multi-language** - Different messages for different locales
3. **Analytics** - Track how many clicks lead to bookings
4. **A/B Testing** - Test different message formats
5. **Auto-fill** - If user logged in, add their info to message
6. **Attachments** - Send vehicle photos via WhatsApp (if supported)
7. **Rate Limiting** - Prevent spam/abuse of WhatsApp API

---

## Reference

- [WhatsApp Click to Chat](https://www.whatsapp.com/business/updates/click-to-chat/)
- [WhatsApp Business API](https://developers.facebook.com/docs/whatsapp/)
- [URL Encoding (RFC 3986)](https://tools.ietf.org/html/rfc3986)
- [WhatsApp Message Format](https://faq.whatsapp.com/general/chats/how-to-format-your-messages/)

---

## Quick Reference

### Generate URL Programmatically

```php
// In Tinker
$vehicle = App\Models\Vehicle::first();
$whatsapp = App\Models\Setting::getValue('whatsapp_number');
$controller = new App\Http\Controllers\VehicleController();
$url = $controller->generateWhatsAppUrl($vehicle, $whatsapp);
echo $url;
```

### Debug Message Content

```php
$vehicle = App\Models\Vehicle::first();
$controller = new App\Http\Controllers\VehicleController();
// Use reflection to access private method
$reflection = new ReflectionMethod($controller, 'buildBookingMessage');
$reflection->setAccessible(true);
$message = $reflection->invoke($controller, $vehicle);
echo $message;
```

---

Enjoy hassle-free WhatsApp bookings! 🚗💬
