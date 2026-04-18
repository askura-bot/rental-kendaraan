# Vehicle Category Management - Admin Feature

## Overview

The vehicle category management feature allows admins to create, view, edit, and delete vehicle categories before adding vehicles. This solves the chicken-and-egg problem where vehicles require categories to exist.

---

## Features

✅ **Create Categories** - Add new vehicle types (Mobil, Motor, Truck, etc.)  
✅ **View Categories** - List all categories with vehicle count  
✅ **Edit Categories** - Update existing category names and slugs  
✅ **Delete Categories** - Remove categories (with validation)  
✅ **Search & Filter** - Find categories quickly  
✅ **Auto-generate Slugs** - Automatically creates URL-friendly slugs  

---

## How to Use

### 1. Access Category Management

**From Vehicle Management Page:**
- Go to `/admin/vehicles`
- Click the "📁 Manage Categories" button
- Or directly visit: `/admin/categories`

### 2. Create a Category

1. Click "**+ Add Category**" button
2. Fill in the category name (e.g., "Mobil", "Motor", "Truck")
3. The slug will auto-generate as you type
4. Click "**Create Category**"

**Example:**
- Name: `Mobil`
- Slug: `mobil` (auto-generated)

### 3. View All Categories

The index page shows:
- Category name
- Slug (URL identifier)
- Number of vehicles in the category
- Edit/Delete action buttons

### 4. Edit a Category

1. Click "**Edit**" on any category
2. Modify the name and/or slug
3. Click "**Update Category**"

### 5. Delete a Category

1. Click "**Delete**" on any category
2. Confirm the deletion

**⚠️ Important:** You cannot delete a category if it has vehicles assigned to it. You must delete or reassign all vehicles first.

---

## File Structure

### Backend

**Controller:**
```
app/Http/Controllers/Admin/CategoryController.php
```
- `index()` - List categories with vehicle count
- `create()` - Show create form
- `store()` - Save new category
- `edit()` - Show edit form
- `update()` - Update category
- `destroy()` - Delete category

**Form Requests (Validation):**
```
app/Http/Requests/StoreCategoryRequest.php
app/Http/Requests/UpdateCategoryRequest.php
```
- Validates category name and slug
- Checks for uniqueness
- Authorization checks

**Routes:**
```
routes/web.php
```
```php
Route::resource('categories', AdminCategoryController::class);
```

### Frontend

**Views:**
```
resources/views/admin/categories/
├── index.blade.php    // List all categories
├── create.blade.php   // Create form
├── edit.blade.php     // Edit form
└── form.blade.php     // Shared form component
```

---

## Validation Rules

### Create Category

```
name:
- Required
- String
- Max 255 characters
- Unique (no duplicates)

slug:
- Required
- String
- Max 255 characters
- Unique (no duplicates)
```

### Update Category

```
Same as above, but allows the current category's existing values
```

---

## Routes

All routes require authentication.

| Method | Path | Name | Description |
|--------|------|------|-------------|
| GET | `/admin/categories` | `admin.categories.index` | List categories |
| GET | `/admin/categories/create` | `admin.categories.create` | Create form |
| POST | `/admin/categories` | `admin.categories.store` | Store new |
| GET | `/admin/categories/{id}/edit` | `admin.categories.edit` | Edit form |
| PUT | `/admin/categories/{id}` | `admin.categories.update` | Update category |
| DELETE | `/admin/categories/{id}` | `admin.categories.destroy` | Delete category |

---

## Quick Start

### Step 1: Create Categories

```bash
# Visit the admin panel
http://localhost:8000/admin/categories
```

### Step 2: Add Categories

Click "**+ Add Category**" and create:
- Mobil (Cars)
- Motor (Motorcycles)
- Truck (Trucks)
- Bus (Buses)

### Step 3: Add Vehicles

Now go to `/admin/vehicles/create` and select your categories from the dropdown.

---

## Auto-Slug Generation

The slug field automatically generates from the name field:

```
Input Name    → Generated Slug
Mobil         → mobil
Motor Manual  → motor-manual
2 Seater      → 2-seater
```

**Manual Override:**
You can edit the slug field manually if needed.

---

## Related Features

### Vehicle Management

Once categories are created, you can:
1. Go to `/admin/vehicles/create`
2. Select a category from the dropdown
3. Create vehicles under that category

### Public Catalog

Categories appear in:
- `/catalog` - Category filter dropdown
- `/vehicles/{id}` - Vehicle detail page (shows category)

---

## Security

✅ **Authorization** - Only authenticated admins can manage categories  
✅ **Validation** - All inputs validated server-side  
✅ **Unique Enforcement** - Database enforces unique names and slugs  
✅ **Deletion Protection** - Can't delete categories with vehicles  

---

## Database

**Table:** `categories`

```sql
CREATE TABLE categories (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    slug VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE INDEX idx_categories_slug ON categories(slug);
```

**Relationships:**
- One category has many vehicles
- Cannot delete category if vehicles exist

---

## Example Workflow

### First Time Setup

```
1. Admin logs in
2. Visits /admin/categories
3. Creates categories:
   - Mobil (for cars)
   - Motor (for motorcycles)
   - Truck (for trucks)
4. Goes to /admin/vehicles/create
5. Selects category from dropdown
6. Creates vehicle in that category
```

### Adding New Category Type

```
1. Realizes there's a new vehicle type needed
2. Goes to /admin/categories
3. Clicks "+ Add Category"
4. Fills in details
5. Goes back to add vehicles
```

---

## Troubleshooting

### "Cannot delete category" error

**Problem:** You're trying to delete a category that has vehicles.

**Solution:**
1. Delete or reassign vehicles to another category
2. Then delete the category

### Slug not auto-generating

**Problem:** Manual edit may have disabled auto-generation.

**Solution:**
1. Clear the slug field
2. Type the name again
3. Slug will auto-generate

### Category dropdown empty when creating vehicles

**Problem:** No categories exist yet.

**Solution:**
1. Go to `/admin/categories`
2. Create at least one category
3. Go back to create vehicle

---

## Best Practices

✅ Use clear, descriptive category names  
✅ Keep slugs simple and lowercase  
✅ Use category names in Indonesian for local business  
✅ Organize categories logically  
✅ Delete unused categories to keep clean  

---

## Links

- **Category Index:** `/admin/categories`
- **Create Category:** `/admin/categories/create`
- **Edit Category:** `/admin/categories/{id}/edit`
- **Vehicle Management:** `/admin/vehicles`
- **Public Catalog:** `/catalog`

---

## Related Documentation

- [Vehicle Management System](ADMIN_VEHICLE_MANAGEMENT.md)
- [Database Schema & Models](RENTAL_SYSTEM_SETUP.md)
- [Public Catalog](PUBLIC_CATALOG_WHATSAPP.md)

---

Your categories are now ready! Start creating vehicle categories and then add vehicles to them. 🚗📁
