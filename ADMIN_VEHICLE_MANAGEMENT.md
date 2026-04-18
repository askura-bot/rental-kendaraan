# Admin Vehicle Management System - Documentation

## Overview

The admin vehicle management system provides a complete interface for managing rental vehicles, including:
- ✅ CRUD operations (Create, Read, Update, Delete)
- ✅ Multiple image upload support (up to 10 images per vehicle)
- ✅ Quick status toggle via AJAX (no page reload)
- ✅ Search and filtering capabilities
- ✅ Dark/Light mode support
- ✅ Responsive design

---

## Accessing the Admin Dashboard

### URL
```
http://localhost:8000/admin/vehicles
```

### Authentication
- Requires user to be logged in
- Currently, all authenticated users have admin access
- **Note:** In production, implement role-based authorization

---

## Features

### 1. Vehicle List (Index)

**Route:** `GET /admin/vehicles`  
**View:** `resources/views/admin/vehicles/index.blade.php`

#### Search & Filters
- **Search** - Find vehicles by name or brand
- **Category** - Filter by vehicle category
- **Status** - Filter by availability status (Available/Rented/Maintenance)
- **Reset** - Clear all filters

#### Quick Status Toggle
- Click the status dropdown to instantly change vehicle status
- Uses AJAX - no page reload required
- Changes are saved immediately to database
- Visual feedback with color-coded status badges:
  - 🟢 Available (Green)
  - 🔵 Rented (Blue)
  - 🟡 Maintenance (Yellow)

#### Table Display
Shows each vehicle with:
- Thumbnail image
- Vehicle name and brand
- Year of manufacture
- Category
- 12h and 24h rental prices
- Current status
- Number of gallery images
- Quick action links (View, Edit, Delete)

---

### 2. Create Vehicle

**Route:** `GET /admin/vehicles/create`  
**View:** `resources/views/admin/vehicles/create.blade.php`

#### Form Fields

**Category Section:**
- Category (dropdown, required)

**Basic Information:**
- Vehicle Name (text, required)
- Brand (text, required)
- Year (number, required, min: 1900, max: current year + 1)
- Engine CC (number, required, min: 100)
- Passenger Capacity (number, required, 1-20)
- Transmission (dropdown: Manual/Automatic, required)

**Pricing:**
- 12-Hour Rental Price (decimal, required)
- 24-Hour Rental Price (decimal, required)
- Status (dropdown: Available/Rented/Maintenance, required)

**Media:**
- Thumbnail Image (optional, max: 2MB, formats: jpeg, png, jpg, webp)
- Gallery Images (optional, up to 10, max: 2MB each)

**Description:**
- Description (textarea, optional, max: 1000 characters)

#### Workflow
1. Fill in all required fields
2. Upload thumbnail image (optional)
3. Upload multiple gallery images (optional)
4. Click "Save Vehicle" to create
5. Redirected to vehicle detail page upon success

---

### 3. View Vehicle Details

**Route:** `GET /admin/vehicles/{vehicle}`  
**View:** `resources/views/admin/vehicles/show.blade.php`

#### Information Displayed
- Thumbnail image (large)
- Basic information (category, brand, year, status)
- Engine specifications (CC, capacity, transmission)
- Pricing information
- Full description
- Gallery with all images
- Created/Updated timestamps

#### Actions
- **Edit** button - Go to edit form
- **Delete** button - Permanently delete vehicle (with confirmation)
- Image modal - Click any gallery image to view full size

---

### 4. Edit Vehicle

**Route:** `GET /admin/vehicles/{vehicle}/edit`  
**View:** `resources/views/admin/vehicles/edit.blade.php`

#### Features
- All form fields pre-filled with current data
- Current thumbnail displayed
- All existing gallery images shown
- Delete individual images by clicking "Delete" on hover
- Upload new images (added to existing gallery)
- Update any field and save changes

#### Workflow
1. Click "Edit" on vehicle list or detail page
2. Modify desired fields
3. Upload new images if needed
4. Click "Save Vehicle" to update
5. Redirected to vehicle detail page upon success

---

### 5. Delete Vehicle

**Route:** `DELETE /admin/vehicles/{vehicle}`

#### Deletion Process
- Deletes vehicle record from database
- Deletes thumbnail image from storage
- Deletes all gallery images from storage
- Confirmation dialog prevents accidental deletion
- Redirects to vehicle list upon success

---

## File Upload & Storage

### Storage Configuration
- **Disk:** `public` (can be accessed via web)
- **Directories:**
  - Thumbnails: `storage/app/public/vehicles/thumbnails/`
  - Gallery: `storage/app/public/vehicles/gallery/`

### Symlink
Ensure storage is linked to public directory:
```bash
php artisan storage:link
```

### Access URLs
- Thumbnail: `storage/vehicles/thumbnails/{filename}`
- Gallery: `storage/vehicles/gallery/{filename}`

---

## AJAX Status Update

### Endpoint
```
POST /admin/vehicles/{vehicle}/update-status
```

### Request Format
```json
{
  "status": "available|rented|maintenance"
}
```

### Response Format
```json
{
  "success": true,
  "status": "available",
  "message": "Status updated successfully."
}
```

### Implementation
The status toggle is handled by JavaScript in the vehicle list:
1. User selects new status from dropdown
2. AJAX request sent to endpoint
3. Database updated
4. Response indicates success
5. Visual feedback provided

---

## Delete Image

### Endpoint
```
DELETE /admin/vehicle-images/{image}
```

### Implementation
- Available in edit view when hovering over existing gallery images
- Click "Delete" to remove image from storage and database
- Confirmation dialog prevents accidental deletion

---

## Validation Rules

### StoreVehicleRequest (Create)
```php
'category_id' => ['required', 'exists:categories,id'],
'name' => ['required', 'string', 'max:255'],
'brand' => ['required', 'string', 'max:255'],
'year' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
'cc' => ['required', 'integer', 'min:100', 'max:10000'],
'capacity' => ['required', 'integer', 'min:1', 'max:20'],
'transmission' => ['required', 'in:manual,automatic'],
'price_12h' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
'price_24h' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
'status' => ['required', 'in:available,rented,maintenance'],
'description' => ['nullable', 'string', 'max:1000'],
'thumbnail' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg,webp'],
'images' => ['nullable', 'array', 'max:10'],
'images.*' => ['image', 'max:2048', 'mimes:jpeg,png,jpg,webp'],
```

### UpdateVehicleRequest (Edit)
Same as StoreVehicleRequest

---

## Authorization

Currently, authorization is checked in Form Requests:
```php
public function authorize(): bool
{
    return $this->user()->isAdmin() ?? false;
}
```

### Production Implementation
For production, implement a proper role system:

**Option 1: Using Gates**
```php
// In AppServiceProvider
Gate::define('manage-vehicles', function (User $user) {
    return $user->role === 'admin';
});
```

**Option 2: Using Policies**
```php
php artisan make:policy VehiclePolicy --model=Vehicle
```

Then check in controller:
```php
$this->authorize('create', Vehicle::class);
```

---

## Database Schema

### Vehicles Table
```
id (primary key)
category_id (foreign key)
name (string)
brand (string)
year (year)
cc (integer)
capacity (integer)
transmission (enum: manual, automatic)
price_12h (decimal 10,2)
price_24h (decimal 10,2)
status (enum: available, rented, maintenance)
description (text, nullable)
thumbnail (string, nullable)
created_at (timestamp)
updated_at (timestamp)
```

### Vehicle Images Table
```
id (primary key)
vehicle_id (foreign key)
image_path (string)
created_at (timestamp)
updated_at (timestamp)
```

---

## Routes

### All Admin Routes
```
GET    /admin/vehicles              → index (list all)
GET    /admin/vehicles/create       → create (show form)
POST   /admin/vehicles              → store (save new)
GET    /admin/vehicles/{vehicle}    → show (display details)
GET    /admin/vehicles/{vehicle}/edit → edit (show form)
PUT    /admin/vehicles/{vehicle}    → update (save changes)
DELETE /admin/vehicles/{vehicle}    → destroy (delete)
POST   /admin/vehicles/{vehicle}/update-status → updateStatus (AJAX)
DELETE /admin/vehicle-images/{image} → deleteImage
```

---

## Testing Data Generation

### Create Test Data Using Tinker
```php
php artisan tinker

// Create categories with vehicles
$categories = App\Models\Category::factory(3)
    ->has(App\Models\Vehicle::factory(5))
    ->create();

// Add images to vehicles
App\Models\Vehicle::all()->each(function ($vehicle) {
    App\Models\VehicleImage::factory(3)->create([
        'vehicle_id' => $vehicle->id
    ]);
});
```

### Using Seeders
```php
php artisan make:seeder VehicleSeeder

// Then in seeder:
$categories = Category::factory(3)->create();
$categories->each(function ($category) {
    $category->vehicles()->createMany(
        Vehicle::factory(5)->make()->toArray()
    );
});
```

---

## Troubleshooting

### Images Not Showing
**Problem:** Images upload successfully but don't display.
**Solution:** Ensure storage symlink exists:
```bash
php artisan storage:link
```

### "The image must be an image" Error
**Solution:** Ensure file MIME type is correct. Server must have image processing libraries:
```bash
# Ubuntu/Debian
sudo apt-get install php-gd

# macOS (Homebrew)
brew install php@8.4-gd
```

### AJAX Status Update Not Working
**Problem:** Status dropdown changes but doesn't save.
**Solution:** Check browser console for errors. Ensure:
1. CSRF token is present in `<meta name="csrf-token">`
2. JavaScript is enabled
3. Server is returning JSON responses

### Authorization Errors (403)
**Solution:** Check `isAdmin()` method in User model. Currently returns `true` for all users.

---

## Performance Optimization

### Query Optimization
The controller already uses eager loading to prevent N+1 queries:
```php
$query = Vehicle::query()->with('category', 'images');
```

### Pagination
Vehicles are paginated with 12 items per page:
```php
$vehicles = $query->paginate(12);
```

### Image Optimization
Consider adding image optimization:
```php
// In StoreVehicleRequest
Image::make($file)->optimize()->save($path);
```

---

## Next Steps

1. **Implement Role-Based Authorization**
   - Add `role` column to users table
   - Create a Policy class for vehicles
   - Update authorization checks

2. **Add Image Optimization**
   - Install Intervention/Image
   - Auto-resize and compress images

3. **Implement Soft Deletes**
   - Add `deleted_at` column
   - Recover deleted vehicles if needed

4. **Add Audit Logging**
   - Track who made changes and when
   - Maintain change history

5. **Create Dashboard Statistics**
   - Total vehicles count
   - Count by status
   - Recent vehicles
   - Popular vehicles

---

## API Examples

### Using the Vehicle API in Your Code

```php
// Get all vehicles
$vehicles = Vehicle::with('category', 'images')->paginate();

// Get single vehicle
$vehicle = Vehicle::findOrFail($id);

// Create vehicle
$vehicle = Vehicle::create([
    'category_id' => 1,
    'name' => 'Toyota Avanza',
    'brand' => 'Toyota',
    'year' => 2023,
    'cc' => 1500,
    'capacity' => 7,
    'transmission' => 'automatic',
    'price_12h' => 250000,
    'price_24h' => 400000,
    'status' => 'available',
    'description' => 'Spacious family car',
]);

// Add images
$vehicle->images()->create(['image_path' => $path]);

// Update status
$vehicle->update(['status' => 'rented']);

// Get available vehicles
$available = Vehicle::where('status', 'available')->get();

// Search vehicles
$search = Vehicle::where('name', 'like', "%$query%")
    ->orWhere('brand', 'like', "%$query%")
    ->get();
```

---

Enjoy managing your vehicle rental fleet! 🚗
