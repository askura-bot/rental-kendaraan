# Laravel 13: Middleware Implementation Guide

## Problem

In Laravel 11+, the constructor-based middleware approach no longer works:

```php
// ❌ OLD (Laravel 10 and earlier)
public function __construct()
{
    $this->middleware('auth');
}
```

This throws: `Undefined method middleware` error.

---

## Solution: Two Modern Approaches

### Option 1: Route Middleware (Apply in routes/web.php)

**Best for:** Simple, controller-wide middleware

**Implementation:**

```php
// routes/web.php

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('vehicles', Admin\VehicleController::class);
    Route::post('vehicles/{vehicle}/update-status', [Admin\VehicleController::class, 'updateStatus'])
        ->name('vehicles.update-status');
    Route::delete('vehicle-images/{image}', [Admin\VehicleController::class, 'deleteImage'])
        ->name('vehicle-images.destroy');
});
```

**Controller (no middleware code needed):**

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    // No middleware in controller - it's all in routes!
    
    public function index(): View
    {
        // ...
    }
}
```

**Pros:**
- ✅ Centralized middleware configuration
- ✅ Easy to see all middleware at route level
- ✅ Simple and clean
- ✅ Perfect for protecting entire route groups

**Cons:**
- ❌ Middleware defined outside the controller
- ❌ Less flexible for method-specific middleware

---

### Option 2: HasMiddleware Interface (In Controller)

**Best for:** Method-specific or mixed middleware strategies

**Implementation:**

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

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
            // Apply 'auth' to all methods
            new Middleware('auth'),
        ];
    }

    public function index(): View
    {
        // All methods require 'auth' middleware
    }
}
```

**Method-Specific Example:**

```php
public static function middleware(): array
{
    return [
        new Middleware('auth'),
        new Middleware('can:edit-vehicles', only: ['edit', 'update']),
        new Middleware('can:delete-vehicles', only: ['destroy']),
        new Middleware('throttle:60,1', only: ['store', 'update']),
    ];
}
```

**Exclude Methods Example:**

```php
public static function middleware(): array
{
    return [
        new Middleware('auth', except: ['index', 'show']),
    ];
}
```

**Pros:**
- ✅ Middleware defined with the controller
- ✅ Supports method-specific middleware
- ✅ Can use `only` and `except`
- ✅ Type-safe with IDE autocomplete
- ✅ Keeps related code together

**Cons:**
- ✅ Slightly more code in the controller

---

## Comparison Table

| Feature | Route Middleware | HasMiddleware |
|---------|------------------|---------------|
| **Code Location** | routes/web.php | Controller class |
| **Controller-wide** | ✅ Simple | ✅ Simple |
| **Method-specific** | ⚠️ Need extra routes | ✅ Easy with `only/except` |
| **Readability** | ✅ Centralized | ✅ Colocated |
| **Maintainability** | ✅ One place | ✅ With controller |
| **IDE Support** | ⚠️ Basic | ✅ Excellent |
| **Flexibility** | ✅ Very flexible | ✅ Very flexible |

---

## Recommended Approach for Laravel 13

### **🏆 HasMiddleware Interface (RECOMMENDED)**

**Why:**

1. **Colocated** - Middleware defined with the controller that uses it
2. **Self-documenting** - Controller clearly shows its security requirements
3. **Maintainable** - Change middleware in controller, not separate route file
4. **Method-specific** - Easy to protect only certain methods
5. **Refactoring-friendly** - Moving/renaming controller keeps middleware intact
6. **Laravel best practice** - This is the modern convention

**When to use Route Middleware:**

- Global/cross-cutting middleware applied to many controllers
- Middleware for entire route groups
- Simple app with minimal complexity

---

## Your Fixed Controller (HasMiddleware)

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Category;
use App\Models\Vehicle;
use App\Models\VehicleImage;
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
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    // Rest of your controller code...
}
```

---

## Applying Different Middleware to Different Methods

### Example: Edit/Delete Requires Extra Authorization

```php
public static function middleware(): array
{
    return [
        new Middleware('auth'),                    // All methods
        new Middleware('can:delete', only: ['destroy']),  // Only delete
        new Middleware('throttle:5,1', only: ['store']),  // Rate limit create
    ];
}
```

### Example: Public View, Private Create/Edit

```php
public static function middleware(): array
{
    return [
        new Middleware('auth', only: ['create', 'store', 'edit', 'update', 'destroy']),
    ];
}
```

### Example: All Except Index

```php
public static function middleware(): array
{
    return [
        new Middleware('auth', except: ['index', 'show']),
    ];
}
```

---

## Migration Guide: Old to New

### Before (Laravel 10 and earlier)

```php
class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:edit', only: ['edit', 'update']);
    }
}
```

### After (Laravel 11+)

```php
class VehicleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('can:edit', only: ['edit', 'update']),
        ];
    }
}
```

---

## Syntax Reference

### Single Middleware

```php
return [
    new Middleware('auth'),
];
```

### Multiple Middleware

```php
return [
    new Middleware('auth'),
    new Middleware('verified'),
    new Middleware('throttle:60,1'),
];
```

### With Method Restrictions

```php
return [
    new Middleware('auth', only: ['create', 'store', 'edit', 'update', 'destroy']),
];

// Or exclude specific methods:
return [
    new Middleware('auth', except: ['index', 'show']),
];
```

### With Parameters

```php
return [
    new Middleware('role:admin'),
    new Middleware('throttle:60,1'),
    new Middleware('signed', only: ['verify']),
];
```

### Closure Middleware

```php
return [
    new Middleware(function ($request, $next) {
        if ($request->user()?->isAdmin()) {
            return $next($request);
        }
        abort(403);
    }),
];
```

---

## Common Middleware Options

| Middleware | Purpose | Example |
|-----------|---------|---------|
| `auth` | Require authenticated user | `new Middleware('auth')` |
| `guest` | Require unauthenticated user | `new Middleware('guest')` |
| `verified` | Require email verification | `new Middleware('verified')` |
| `throttle:limit,minutes` | Rate limiting | `new Middleware('throttle:60,1')` |
| `can:ability` | Authorization check | `new Middleware('can:edit-posts')` |
| `role:name` | Role-based access | `new Middleware('role:admin')` |
| `signed` | Validate signed URLs | `new Middleware('signed')` |
| `throttle:60,1` | 60 requests per 1 minute | `new Middleware('throttle:60,1')` |

---

## Testing Middleware

### Verify Middleware is Applied

```php
// tests/Feature/VehicleTest.php

public function test_vehicle_create_requires_auth()
{
    $this->get('/admin/vehicles/create')
        ->assertRedirect('/login');
}

public function test_vehicle_create_allowed_when_authenticated()
{
    $user = User::factory()->create();
    
    $this->actingAs($user)
        ->get('/admin/vehicles/create')
        ->assertOk();
}
```

---

## Troubleshooting

### Error: "Undefined method middleware"

**Solution:** Use `HasMiddleware` interface with `middleware()` static method.

```php
class VehicleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware('auth')];
    }
}
```

### Middleware Not Working

**Check:**
1. ✅ Is the controller implementing `HasMiddleware`?
2. ✅ Is the `middleware()` method `public static`?
3. ✅ Does the controller have correct return type `array`?
4. ✅ Are routes using the controller?

```bash
php artisan route:list
```

### IDE Not Autocompleting Middleware

**Fix:**
```php
// Import the Middleware class
use Illuminate\Routing\Controllers\Middleware;
```

---

## Summary

| Question | Answer |
|----------|--------|
| **What changed?** | Constructor middleware no longer works in Laravel 11+ |
| **What's recommended?** | Use `HasMiddleware` interface in controller |
| **When to use route middleware?** | For global/group middleware, not controller-specific |
| **Can I still use route middleware?** | Yes, both approaches work together |
| **Is it breaking?** | No, existing route middleware still works |
| **Do I need to migrate all controllers?** | Only if you have constructor middleware |
| **What's the syntax?** | `implements HasMiddleware` + `public static function middleware(): array` |

---

## Next Steps

1. ✅ Update your controller to use `HasMiddleware` (already done!)
2. Run tests to verify middleware is applied correctly
3. Check routes with `php artisan route:list`
4. Update any other controllers using constructor middleware

---

## Resources

- [Laravel 13 Middleware Documentation](https://laravel.com/docs/13/middleware)
- [Routing: Assigning Middleware to Controllers](https://laravel.com/docs/13/routing#controller-middleware)
- [HasMiddleware Interface](https://laravel.com/api/13.x/Illuminate/Routing/Controllers/HasMiddleware.html)

---

Your `VehicleController` is now using the modern `HasMiddleware` approach! 🎉
