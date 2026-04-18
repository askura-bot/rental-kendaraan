# Quick Start: Admin Vehicle Management

## 🚀 Get Started in 3 Steps

### Step 1: Login to Your Application
```
http://localhost:8000/admin/vehicles
```
(Requires authentication via Laravel Breeze)

### Step 2: Create Test Data
Run in terminal:
```bash
php artisan tinker
```

Then in Tinker:
```php
$categories = App\Models\Category::factory(3)->create();
$categories->each(fn($cat) => App\Models\Vehicle::factory(5)
    ->for($cat)
    ->has(App\Models\VehicleImage::factory(3))
    ->create()
);
exit
```

### Step 3: Start Managing
Visit `/admin/vehicles` to see your vehicle list!

---

## 📋 Key Features at a Glance

| Feature | Where | How |
|---------|-------|-----|
| **List Vehicles** | `/admin/vehicles` | View all with search/filters |
| **Create Vehicle** | `/admin/vehicles/create` | Add new vehicle with images |
| **Edit Vehicle** | `/admin/vehicles/{id}/edit` | Update info and add more images |
| **Quick Status Toggle** | Vehicle list dropdown | Change status instantly (AJAX) |
| **View Details** | `/admin/vehicles/{id}` | See full specs and gallery |
| **Delete Vehicle** | Confirmation dialog | Removes vehicle and all images |
| **Delete Image** | Edit page hover | Remove single images from gallery |

---

## 📂 Files Created

### Controllers
- `app/Http/Controllers/Admin/VehicleController.php` - Main controller with CRUD & status toggle

### Form Requests (Validation)
- `app/Http/Requests/StoreVehicleRequest.php` - Create validation
- `app/Http/Requests/UpdateVehicleRequest.php` - Update validation

### Views
- `resources/views/admin/vehicles/index.blade.php` - Vehicle list with AJAX toggle
- `resources/views/admin/vehicles/create.blade.php` - Create form
- `resources/views/admin/vehicles/edit.blade.php` - Edit form
- `resources/views/admin/vehicles/show.blade.php` - Detail view
- `resources/views/admin/vehicles/form.blade.php` - Shared form component

### Routes
Added to `routes/web.php`:
```php
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('vehicles', VehicleController::class);
    Route::post('vehicles/{vehicle}/update-status', ...);
    Route::delete('vehicle-images/{image}', ...);
});
```

---

## 🎨 UI Features

✅ **Dark/Light Mode** - Automatically adapts to system theme  
✅ **Responsive Design** - Works on desktop, tablet, mobile  
✅ **Color-Coded Status** - Green (Available), Blue (Rented), Yellow (Maintenance)  
✅ **Image Previews** - Live preview before upload  
✅ **Drag & Drop** - Drop images to upload (with fallback)  
✅ **AJAX Updates** - No page reload for status changes  
✅ **Confirmation Dialogs** - Prevent accidental deletions  

---

## 🔧 Configuration

### Image Storage
- Stored in: `storage/app/public/vehicles/`
- Max size: 2MB per image
- Formats: JPEG, PNG, WebP
- Galleries: Up to 10 images per vehicle

### Database
- All tables created with proper relationships
- Foreign key constraints with cascade delete
- Indexed columns for performance

### Authorization
Currently: ✅ All authenticated users are admins  
Production: 🔒 Implement role-based access control

---

## 🎯 Common Tasks

### Create a Vehicle
1. Go to `/admin/vehicles/create`
2. Fill in required fields
3. Upload thumbnail (optional)
4. Upload gallery images (optional)
5. Click "Save Vehicle"

### Update Vehicle Status
1. Go to `/admin/vehicles`
2. Click status dropdown on any vehicle
3. Select new status (Available/Rented/Maintenance)
4. Status updates instantly via AJAX

### Delete a Vehicle
1. Go to `/admin/vehicles`
2. Click "Delete" link in actions
3. Confirm deletion
4. Vehicle and all images are removed

### Search Vehicles
1. Go to `/admin/vehicles`
2. Enter name or brand in search box
3. Select category or status filters (optional)
4. Click "Filter"

---

## 📊 Database Structure

```
categories
  ├── id
  ├── name (unique)
  ├── slug (unique)
  └── relationships: hasMany(vehicles)

vehicles
  ├── id
  ├── category_id (FK → categories)
  ├── name, brand, year, cc, capacity
  ├── transmission (manual/automatic)
  ├── price_12h, price_24h
  ├── status (available/rented/maintenance)
  ├── description, thumbnail
  ├── timestamps
  ├── relationships: belongsTo(category), hasMany(images)

vehicle_images
  ├── id
  ├── vehicle_id (FK → vehicles)
  ├── image_path
  ├── timestamps
  └── relationships: belongsTo(vehicle)

settings
  ├── id
  ├── key (unique)
  ├── value (JSON/text)
  └── timestamps
```

---

## 🐛 Troubleshooting

**Problem:** Images don't show after upload  
**Solution:** Run `php artisan storage:link`

**Problem:** 403 Authorization Error  
**Solution:** Check that you're logged in and `isAdmin()` returns true

**Problem:** AJAX status toggle not working  
**Solution:** Check browser console. Verify CSRF token is in page header.

**Problem:** File upload fails with "image must be an image"  
**Solution:** Verify MIME type is correct (JPEG/PNG). Check server GD extension.

---

## 📚 Full Documentation

For detailed information, see:
- [ADMIN_VEHICLE_MANAGEMENT.md](ADMIN_VEHICLE_MANAGEMENT.md) - Complete guide
- [RENTAL_SYSTEM_SETUP.md](RENTAL_SYSTEM_SETUP.md) - Database & models info

---

## ✨ Next Steps

Ready to build more features? Here's what's recommended next:

1. **Categories Admin Panel** - Manage vehicle categories
2. **Settings Admin Panel** - Update WhatsApp number & T&C
3. **Dashboard Statistics** - Show stats on main dashboard
4. **Public Catalog Page** - Display vehicles to customers
5. **Booking System** - WhatsApp integration for reservations

---

## 💡 Tips

- Use searchable dropdowns for better UX
- Add bulk actions (edit multiple vehicles)
- Implement image optimization for faster loading
- Add vehicle availability calendar
- Create vehicle comparison feature
- Add customer reviews/ratings

Enjoy! 🎉
