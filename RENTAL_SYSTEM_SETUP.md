# Vehicle Rental Catalog & WhatsApp Reservation System - Setup Complete ✅

## Database Schema & Models Generated

### 1. **Categories Table & Model**
**Migration:** `2026_04_17_075551_create_categories_table.php`

**Schema:**
- `id` - Primary key
- `name` - Unique vehicle category name (e.g., "Mobil", "Motor")
- `slug` - URL-friendly version of name
- `timestamps` - Created/Updated timestamps

**Model:** `app/Models/Category.php`
- Fillable: `name`, `slug`
- Relationship: `hasMany(Vehicle::class)`

---

### 2. **Vehicles Table & Model**
**Migration:** `2026_04_17_075555_create_vehicles_table.php`

**Schema:**
- `id` - Primary key
- `category_id` - Foreign key to categories (with cascade delete)
- `name` - Vehicle name
- `brand` - Vehicle brand
- `year` - Year of manufacture (year type)
- `cc` - Engine displacement (unsigned int)
- `capacity` - Passenger capacity (unsigned int)
- `transmission` - Enum: `manual` or `automatic`
- `price_12h` - Rental price for 12 hours (decimal 10,2)
- `price_24h` - Rental price for 24 hours (decimal 10,2)
- `status` - Enum: `available`, `rented`, `maintenance` (default: `available`)
- `description` - Detailed vehicle description (text, nullable)
- `thumbnail` - Thumbnail image path (string, nullable)
- `timestamps` - Created/Updated timestamps
- **Indexes:** `category_id`, `status`

**Model:** `app/Models/Vehicle.php`
- Fillable: `category_id`, `name`, `brand`, `year`, `cc`, `capacity`, `transmission`, `price_12h`, `price_24h`, `status`, `description`, `thumbnail`
- Casts: All numeric fields, prices as decimals, dates as Carbon instances
- Relationships:
  - `belongsTo(Category::class)`
  - `hasMany(VehicleImage::class)`

---

### 3. **Vehicle Images Table & Model**
**Migration:** `2026_04_17_075556_create_vehicle_images_table.php`

**Schema:**
- `id` - Primary key
- `vehicle_id` - Foreign key to vehicles (with cascade delete)
- `image_path` - Path to image file
- `timestamps` - Created/Updated timestamps
- **Index:** `vehicle_id`

**Model:** `app/Models/VehicleImage.php`
- Fillable: `vehicle_id`, `image_path`
- Relationship: `belongsTo(Vehicle::class)`

---

### 4. **Settings Table & Model**
**Migration:** `2026_04_17_075558_create_settings_table.php`

**Schema:**
- `id` - Primary key
- `key` - Unique setting identifier (string, unique)
- `value` - Setting value (longText, nullable)
- `timestamps` - Created/Updated timestamps

**Model:** `app/Models/Setting.php`
- Fillable: `key`, `value`
- Uses `key` as primary key (non-incrementing)
- **Helpful Methods:**
  - `Setting::getValue(key, default)` - Get a setting value
  - `Setting::setValue(key, value)` - Set/update a setting
- **Typical Usage:**
  ```php
  // Get WhatsApp number
  $whatsapp = Setting::getValue('whatsapp_number');
  
  // Get T&C
  $terms = Setting::getValue('terms_and_conditions');
  
  // Update WhatsApp number
  Setting::setValue('whatsapp_number', '62812345678');
  ```

---

## Data Factories Created

All factories are production-ready and use Faker to generate realistic test data:

### CategoryFactory
- Generates random unique category names with slugs

### VehicleFactory
- Creates vehicles with complete data
- Auto-associates with a Category
- Generates realistic car specs (CC, capacity, year, etc.)
- Random status and pricing

### VehicleImageFactory
- Creates images associated with vehicles
- Auto-creates related vehicle if not specified

---

## Model Relationships Overview

```
User (from Laravel Breeze)
Category
├── hasMany(Vehicle)

Vehicle
├── belongsTo(Category)
└── hasMany(VehicleImage)

VehicleImage
└── belongsTo(Vehicle)

Setting
└── Standalone (key-value storage)
```

---

## Quick Start: Generate Test Data

```php
// Using Tinker or seeders
php artisan tinker

// Create categories with vehicles
$categories = \App\Models\Category::factory(3)
    ->has(\App\Models\Vehicle::factory(5))
    ->create();

// Add images to vehicles
\App\Models\Vehicle::all()->each(function ($vehicle) {
    \App\Models\VehicleImage::factory(3)->create([
        'vehicle_id' => $vehicle->id
    ]);
});

// Set initial settings
\App\Models\Setting::setValue('whatsapp_number', '62812345678');
\App\Models\Setting::setValue('terms_and_conditions', 'Your T&C text here...');
```

---

## Next Steps

You now have:
✅ Complete database schema with proper relationships
✅ All models with type hints and relationships
✅ Test factories for generating sample data
✅ Migrations applied and ready to use

### Ready to build:
1. **Controllers** - CategoryController, VehicleController, AdminController, SettingsController
2. **Routes** - Public routes (catalog, detail pages) and admin routes
3. **Views** - Landing page, catalog, detail page, info page, admin dashboard
4. **API Resources** - For structured vehicle data responses
5. **Form Requests** - For validation in create/update operations
6. **Policies** - For authorization (admin-only actions)

---

## Database Connection
- Database: PostgreSQL
- All migrations applied and tables created
- Foreign keys properly configured with cascade delete

Enjoy building your rental system! 🚗
