# Public Vehicle Catalog & WhatsApp Booking System

## Overview

The public vehicle catalog system provides customers with an intuitive interface to browse, search, and book rental vehicles via WhatsApp. The system includes:

- ✅ Responsive vehicle catalog with search & filters
- ✅ Detailed vehicle page with specifications
- ✅ WhatsApp booking integration (pre-filled messages)
- ✅ Related vehicles recommendations
- ✅ Image gallery with modal viewer
- ✅ Dark/Light mode support

---

## Public Routes

### Catalog Page
**URL:** `http://localhost:8000/catalog`  
**Route Name:** `catalog`  
**Controller:** `VehicleController@catalog()`

### Vehicle Detail Page
**URL:** `http://localhost:8000/vehicles/{vehicle_id}`  
**Route Name:** `vehicle-detail`  
**Controller:** `VehicleController@show(Vehicle $vehicle)`

---

## Features

### Catalog Page (`/catalog`)

#### Search & Filters
- **Search** - Find by vehicle name or brand (case-insensitive)
- **Category** - Filter by vehicle category with count display
- **Transmission** - Filter by manual or automatic
- **Price Range** - Filter by minimum and maximum 24-hour rental price
- **Reset Button** - Clear all filters

#### Display
- **Grid Layout** - 4 columns on desktop, 2 on tablet, 1 on mobile
- **Pagination** - 12 vehicles per page
- **Vehicle Cards** showing:
  - Thumbnail image with hover zoom effect
  - Vehicle name, brand, year
  - Specifications (CC, seats, transmission, photos count)
  - 12h and 24h rental prices
  - "View Details" button
  - "Available" badge

#### Query Optimization
- Eager loads relationships: `category`, `images`
- Only shows available vehicles (`status === 'available'`)
- Ordered by newest first (`created_at DESC`)

---

### Vehicle Detail Page (`/vehicles/{id}`)

#### Layout
- **Left Column (2/3 width)**
  - Main image viewer with click-to-enlarge
  - Thumbnail gallery with quick switch
  - Specifications grid (6 items)
  - Full description

- **Right Column (1/3 width)** - Sticky
  - Pricing section (12h and 24h)
  - WhatsApp booking button
  - Pre-booking info box

#### Specifications Display
Shows 6 key specs with color-coded borders:
- 🔵 Brand
- 🟢 Year
- 🟣 Category
- 🔴 Engine (CC)
- 🟡 Capacity (seats)
- 🟦 Transmission type

#### Image Gallery
- Main image with full-size modal viewer
- Thumbnail grid for quick switching
- Thumbnail count display
- Keyboard support (ESC to close modal)

#### Related Vehicles
- Shows 4 similar vehicles from same category
- Excludes current vehicle
- Links to their detail pages
- Compact card design

#### Info Box
Pre-booking checklist:
- Have ID ready
- Valid driving license
- Prepare security deposit
- Check terms & conditions

---

## WhatsApp Integration

### How It Works

1. **Get WhatsApp Number**
   ```php
   $whatsappNumber = Setting::getValue('whatsapp_number', '');
   ```

2. **Format Phone Number**
   - Removes all non-numeric characters
   - If doesn't start with country code (62), adds "62" prefix
   - Example: `0812345678` → `62812345678`

3. **Build Message**
   ```
   Halo! Saya tertarik untuk menyewa kendaraan berikut:

   🚗 *Vehicle Name*
   Brand: Toyota
   Tahun: 2023
   Transmisi: Automatic
   Kapasitas: 7 penumpang

   💰 Harga:
   12 Jam: Rp 250.000
   24 Jam: Rp 400.000

   📅 Tanggal sewa: [Masukkan tanggal]
   ⏰ Durasi: [12 jam / 24 jam]

   Mohon konfirmasi ketersediaan dan proses selanjutnya.
   Terima kasih!
   ```

4. **Generate URL**
   ```
   https://wa.me/62812345678?text={urlEncodedMessage}
   ```

### WhatsApp URL Format

The system generates WhatsApp URLs in this format:
```
https://wa.me/{phoneNumber}?text={message}
```

**Parameters:**
- `phoneNumber` - Country code + phone number (no + or 0)
- `text` - URL-encoded message body

**Example:**
```
https://wa.me/62812345678?text=Halo%21%20Saya%20tertarik...
```

### Message Template

The `buildBookingMessage()` method creates a professional message including:
- Polite greeting
- Vehicle details (name, brand, year, transmission, capacity)
- 12-hour and 24-hour prices
- Placeholders for customer to fill in (date, duration)
- Professional closing

---

## Database Configuration

### Required Settings
Before using the catalog, ensure these settings exist:

```php
// WhatsApp Number (required for booking button)
Setting::setValue('whatsapp_number', '62812345678');

// Terms & Conditions (used on info page)
Setting::setValue('terms_and_conditions', 'Your T&C text...');
```

### Default Settings
Run the seeder to create default settings:
```bash
php artisan db:seed --class=SettingSeeder
```

Or seed everything:
```bash
php artisan db:seed
```

---

## Controller Methods

### `catalog(Request $request): View`

**Purpose:** Display paginated vehicle catalog with filters

**Parameters:**
- `search` - Search term (name or brand)
- `category` - Category ID
- `transmission` - manual or automatic
- `price_min` - Minimum 24-hour price
- `price_max` - Maximum 24-hour price

**Returns:**
- `vehicles` - Paginated collection
- `categories` - All categories with vehicle count

**Example Request:**
```php
GET /catalog?search=avanza&category=1&transmission=automatic&price_min=300000&price_max=500000
```

### `show(Vehicle $vehicle): View`

**Purpose:** Display vehicle detail page with booking option

**Parameters:**
- `vehicle` - Vehicle model (auto-injected via implicit binding)

**Returns:**
- `vehicle` - Vehicle with relations loaded
- `whatsappUrl` - Generated WhatsApp booking link
- `relatedVehicles` - Similar vehicles from same category

**Features:**
- Returns 404 if vehicle is not available
- Loads category, images, and related vehicles
- Pre-generates WhatsApp URL

---

## Views

### `catalog.blade.php`
- Responsive catalog grid
- Search and filter form
- Pagination links
- Results counter
- Empty state

### `vehicle-detail.blade.php`
- Image gallery with modal
- Specifications grid
- Description section
- Pricing display
- WhatsApp booking button
- Info box
- Related vehicles carousel

---

## Styling & Responsiveness

### Breakpoints
- **Mobile:** < 640px (1 column)
- **Tablet:** 640px - 1024px (2 columns)
- **Desktop:** > 1024px (3-4 columns)

### Dark Mode
- All components support dark mode
- Uses Tailwind `dark:` variant
- Automatic detection based on system preference

### Interactive Elements
- Hover effects with smooth transitions
- Image zoom on hover
- Status badges with color coding
- Smooth scroll behavior

---

## URL Encoding

WhatsApp messages are URL-encoded to handle special characters:

```javascript
const message = "Halo! Saya tertarik...";
const encoded = encodeURIComponent(message);
// Result: "Halo%21%20Saya%20tertarik..."
```

Characters automatically encoded:
- Space → `%20`
- Exclamation → `%21`
- Asterisk → `%2A` (used in bold formatting)
- Newline → `%0A`
- And more...

---

## Testing

### Manual Testing

1. **Test Catalog Page:**
   ```bash
   # Visit catalog
   http://localhost:8000/catalog
   
   # Test search
   ?search=toyota
   
   # Test filters
   ?category=1&transmission=automatic
   
   # Test price filter
   ?price_min=300000&price_max=500000
   ```

2. **Test Detail Page:**
   ```bash
   # Visit vehicle detail (replace 1 with actual vehicle ID)
   http://localhost:8000/vehicles/1
   ```

3. **Test WhatsApp Link:**
   - Click "Book via WhatsApp" button
   - Should open WhatsApp with pre-filled message
   - Message includes vehicle details

### Create Test Data

```bash
php artisan tinker
```

```php
$categories = App\Models\Category::factory(3)->create();
$categories->each(function($cat) {
    App\Models\Vehicle::factory(10)
        ->for($cat)
        ->has(App\Models\VehicleImage::factory(3))
        ->create(['status' => 'available']);
});
```

---

## Performance Considerations

### Query Optimization
- Uses eager loading to prevent N+1 queries
- Pagination limits results per page
- Indexed columns: `category_id`, `status`

### Image Optimization
- Thumbnail images used in catalog (faster loading)
- Full images in modal on demand
- Consider WebP format for future optimization

### Caching Opportunities
```php
// Cache category list (rarely changes)
$categories = Cache::rememberForever('categories', function () {
    return Category::withCount('vehicles')->get();
});
```

---

## Common Issues & Solutions

### WhatsApp Link Not Working
**Problem:** Clicking WhatsApp button does nothing  
**Solution:** Check browser console for errors, ensure WhatsApp number is set in database

### Images Not Showing
**Problem:** Thumbnails show placeholder  
**Solution:** Run `php artisan storage:link`, check file paths in database

### Filter Not Working
**Problem:** Selected filters don't apply  
**Solution:** Check form method is GET, verify parameter names match controller

### Modal Not Opening
**Problem:** Clicking image doesn't show modal  
**Solution:** Check browser console, ensure JavaScript is enabled

---

## Future Enhancements

1. **Reviews & Ratings** - Add customer reviews to detail page
2. **Booking Calendar** - Show available dates/times
3. **Advanced Search** - Filter by features, amenities
4. **Comparison** - Compare multiple vehicles side-by-side
5. **Wishlist** - Save favorite vehicles
6. **Email Notifications** - Notify about special offers
7. **Payment Integration** - Direct payment option
8. **Instant Chat** - In-page chat with support

---

## Configuration Reference

### Environment Variables (`.env`)
```
APP_NAME="Rental Kendaraan"
APP_URL=http://localhost:8000
```

### WhatsApp Settings (Database)
```php
// Set WhatsApp number
Setting::setValue('whatsapp_number', '62812345678');

// View WhatsApp number
$number = Setting::getValue('whatsapp_number');
```

---

## Support

For issues or questions:
1. Check the [ADMIN_VEHICLE_MANAGEMENT.md](ADMIN_VEHICLE_MANAGEMENT.md) for admin features
2. Review database schema in [RENTAL_SYSTEM_SETUP.md](RENTAL_SYSTEM_SETUP.md)
3. Check browser console for JavaScript errors
4. Verify database connections and file storage

Happy renting! 🚗
