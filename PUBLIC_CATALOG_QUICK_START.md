# Public Catalog & WhatsApp Booking - Quick Start Guide

## 🚀 Get Started in 3 Steps

### Step 1: Create Test Vehicles
Run in terminal:
```bash
php artisan tinker
```

Then in Tinker:
```php
// Create 3 categories
$categories = App\Models\Category::factory(3)->create();

// Create 15 available vehicles with images
$categories->each(function($cat) {
    App\Models\Vehicle::factory(5)
        ->for($cat)
        ->state(['status' => 'available'])
        ->has(App\Models\VehicleImage::factory(3))
        ->create();
});

// Exit Tinker
exit
```

### Step 2: Verify WhatsApp Settings
```bash
php artisan tinker
```

Then:
```php
// Check WhatsApp number
echo App\Models\Setting::getValue('whatsapp_number');
// Should output: 62812345678

exit
```

### Step 3: Visit the Catalog
Open your browser:
```
http://localhost:8000/catalog
```

---

## 📱 Features Available

### Catalog Page (`/catalog`)
✅ **Browse** - See all available vehicles in grid layout  
✅ **Search** - Find vehicles by name or brand  
✅ **Filter** - Filter by category, transmission, price range  
✅ **Pagination** - Navigate through vehicle pages (12 per page)  
✅ **Cards** - View essential info: photos, specs, pricing  

### Vehicle Detail (`/vehicles/{id}`)
✅ **Full Gallery** - View all vehicle photos  
✅ **Image Modal** - Click to enlarge photos  
✅ **Specifications** - Complete vehicle details  
✅ **Description** - Full vehicle description  
✅ **Pricing** - Clear 12h and 24h pricing  
✅ **WhatsApp Booking** - One-click booking with pre-filled message  
✅ **Related Vehicles** - See similar vehicles from same category  

---

## 🎯 Try These Actions

### Search & Filter
1. Go to `/catalog`
2. Type "Toyota" in search box → Click Filter
3. Select a category → Click Filter
4. Set price range (e.g., 300000 - 500000) → Click Filter
5. Combine multiple filters
6. Click "Reset" to clear all

### View Vehicle Details
1. Go to `/catalog`
2. Click "View Details" on any vehicle
3. Click any thumbnail to view that image
4. Click main image to open modal viewer
5. Press ESC or click X to close modal
6. Scroll down to see related vehicles

### Book via WhatsApp
1. Go to any vehicle detail page
2. Click "Book via WhatsApp" button (green button on right)
3. WhatsApp should open with pre-filled message including:
   - Vehicle name, brand, year
   - CC, capacity, transmission
   - 12h and 24h pricing
   - Placeholders for your dates and preferred duration

**Note:** First time might ask to select WhatsApp Desktop or Web  
On mobile, automatically opens WhatsApp app

---

## 📊 URL Examples

### Catalog with Filters
```
/catalog
/catalog?search=avanza
/catalog?category=1
/catalog?transmission=automatic
/catalog?price_min=200000&price_max=400000
/catalog?category=1&transmission=manual&price_min=150000
```

### Vehicle Detail
```
/vehicles/1
/vehicles/2
/vehicles/3
```

---

## 🔍 Test Data Summary

After running the seeder, you'll have:
- ✅ 3 vehicle categories
- ✅ 15 available vehicles
- ✅ 45 vehicle gallery images (3 per vehicle)
- ✅ WhatsApp number: `62812345678`
- ✅ Default Terms & Conditions

---

## 💡 WhatsApp Booking Message Format

The message sent automatically includes:

```
Halo! Saya tertarik untuk menyewa kendaraan berikut:

🚗 *Toyota Avanza*
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

Customer can then fill in their actual dates and duration.

---

## 🎨 Dark Mode

The pages automatically support dark mode:
- On desktop: Check system settings
- On Mac: System Preferences → General → Appearance
- On Windows: Settings → Personalization → Colors
- Or browser extension for quick toggle

All pages will adapt to dark theme instantly!

---

## 📱 Mobile Responsiveness

Test on different screen sizes:
- **Mobile** (< 640px) - 1 column grid
- **Tablet** (640-1024px) - 2 column grid
- **Desktop** (> 1024px) - 3-4 column grid

Try resizing browser window or use DevTools responsive mode (F12).

---

## 🔧 Troubleshooting

### Catalog shows "No vehicles found"
✅ Solution: Create test data using Step 1 above

### WhatsApp button doesn't work
✅ Solution: 
- Check WhatsApp is installed on device
- Try different browser
- Check browser console (F12) for errors
- Verify WhatsApp number is set: `php artisan tinker` then `echo App\Models\Setting::getValue('whatsapp_number');`

### Images don't show
✅ Solution:
```bash
php artisan storage:link
```

### Price filters not working
✅ Solution:
- Verify prices are entered as numbers
- Check that min price < max price
- Prices are filtered on 24-hour rental price

### Search not returning results
✅ Solution:
- Try different search terms
- Check exact spelling (case-insensitive but should match)
- Try partial words

---

## 📚 Full Documentation

See [PUBLIC_CATALOG_WHATSAPP.md](PUBLIC_CATALOG_WHATSAPP.md) for:
- Complete feature documentation
- WhatsApp URL encoding details
- Database configuration
- Performance optimization
- API examples
- Advanced testing scenarios

---

## 🚀 Next Steps

After testing the public catalog:

1. **Create Settings Admin Panel** - Manage WhatsApp number and T&C
2. **Create Info Page** - Display T&C and map location
3. **Booking System** - Full reservation management
4. **Dashboard Stats** - Show vehicle stats on home page
5. **Admin Reports** - Generate booking reports

---

## ✅ Checklist

- [ ] Created test vehicles
- [ ] Verified WhatsApp settings
- [ ] Visited `/catalog` page
- [ ] Tested search functionality
- [ ] Tested filters (category, transmission, price)
- [ ] Clicked on vehicle card to view details
- [ ] Viewed image gallery
- [ ] Clicked WhatsApp booking button
- [ ] Message appeared in WhatsApp with vehicle details
- [ ] Tested dark mode
- [ ] Tested on mobile size

---

## 📞 Support

If you encounter issues:
1. Check troubleshooting section above
2. Review full documentation: [PUBLIC_CATALOG_WHATSAPP.md](PUBLIC_CATALOG_WHATSAPP.md)
3. Check Laravel logs: `storage/logs/laravel.log`
4. Check browser console errors (F12 → Console tab)

Happy testing! 🎉
