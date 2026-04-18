# Rental Kendaraan - Vehicle Rental Management System

A modern, full-featured web application for managing vehicle rentals. Built with **Laravel 13**, **PHP 8.4**, and **Tailwind CSS v4**, this system provides a complete solution for vehicle catalog management and public browsing.

## 🎯 Features

### Admin Dashboard
- **Vehicle Management**
  - Create, read, update, and delete vehicles
  - Manage multiple vehicle images with client-side compression (40-80% size reduction)
  - Auto-generated URL-friendly slugs for improved security
  - Vehicle categorization and status management
  - Search and filtering capabilities

- **Category Management**
  - Organize vehicles into categories
  - Auto-slug generation from category names
  - Prevent deletion of categories with active vehicles
  - Search and pagination

- **User Management**
  - Role-based authentication (Admin only)
  - Admin account creation on registration
  - Profile management and logout functionality

### Public Catalog
- **Vehicle Browsing**
  - Browse all available vehicles without login
  - Search vehicles by name/brand
  - Filter by category, transmission type, and price range
  - Responsive grid layout with vehicle images
  - Detailed vehicle information pages

- **Responsive Design**
  - Fully responsive across desktop, tablet, and mobile devices
  - Mobile-optimized hamburger menu navigation
  - Dark mode support

## 🛠 Tech Stack

- **Backend:** Laravel 13 with PHP 8.4
- **Frontend:** Blade templating with Tailwind CSS v4
- **Authentication:** Laravel Breeze v2
- **Image Processing:** Client-side compression via CDN (browser-image-compression)
- **Database:** MySQL/MariaDB with Eloquent ORM
- **Testing:** Pest PHP v4
- **Code Quality:** Laravel Pint (PSR-12 compliant)

## 📋 Requirements

- PHP 8.4+
- Composer
- MySQL/MariaDB database
- Node.js & npm (for frontend assets)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/askura-bot/rental-kendaraan.git
   cd rental_kendaraan
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   - Update `.env` with your database credentials
   - Run migrations:
   ```bash
   php artisan migrate
   ```

5. **Create storage symlink**
   ```bash
   php artisan storage:link
   ```

6. **Build frontend assets**
   ```bash
   npm run build
   ```

7. **Start the application**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to access the application.

## 📂 Project Structure

```
rental_kendaraan/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── VehicleController.php    (Admin & Public)
│   │   │   └── CategoryController.php   (Admin)
│   │   └── Requests/                    (Form validation)
│   └── Models/
│       ├── User.php                     (Role-based)
│       ├── Vehicle.php                  (Slug generation)
│       ├── Category.php
│       └── VehicleImage.php
├── resources/
│   ├── views/
│   │   ├── admin/                       (Admin panel)
│   │   ├── components/
│   │   │   ├── admin-navigation.blade.php
│   │   │   └── user-navigation.blade.php
│   │   └── auth/                        (Authentication)
│   ├── css/
│   │   └── app.css                      (Tailwind styles)
│   └── js/
│       └── app.js                       (Frontend logic)
├── routes/
│   ├── web.php                          (Web routes)
│   └── auth.php                         (Auth routes)
├── database/
│   ├── migrations/                      (Schema)
│   └── factories/                       (Test data)
└── tests/
    ├── Feature/                         (Feature tests)
    └── Unit/                            (Unit tests)
```

## 🔐 Security Features

- **Slug-based URLs:** Vehicles use URL-friendly slugs instead of exposed database IDs
- **Role-based Access:** Only administrators can access the admin panel
- **Form Validation:** Comprehensive validation on all user inputs
- **CSRF Protection:** Built-in Laravel CSRF token validation
- **Client-side Image Compression:** Reduce upload sizes before transmission
- **Storage Symlink:** Secure public file access through Laravel's storage system

## 🧪 Testing

Run the test suite with Pest:

```bash
php artisan test --compact
```

Filter tests by name:
```bash
php artisan test --compact --filter=testName
```

## 📝 Usage

### Creating a Vehicle (Admin Only)
1. Log in with admin credentials
2. Navigate to **Vehicles** → **Create**
3. Fill in vehicle details (name, brand, price, etc.)
4. Select category and upload images
5. Images are automatically compressed before upload
6. Save to generate slug-based URL

### Browsing Vehicles (Public)
1. Visit the public catalog at `/catalog`
2. Search by vehicle name or brand
3. Filter by category, transmission, or price range
4. Click on a vehicle for detailed information
5. Contact via WhatsApp button

## 🎨 Customization

- **Branding:** Update logo in `resources/views/components/application-logo.blade.php`
- **Colors:** Configure Tailwind in `tailwind.config.js`
- **Image Compression:** Adjust settings in vehicle form view
- **Database:** Modify schema in `database/migrations/`

## 📄 Environment Variables

Key environment variables in `.env`:

```
APP_NAME="Rental Kendaraan"
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rental_kendaraan
DB_USERNAME=root
DB_PASSWORD=
```

## 🐛 Troubleshooting

**Images not displaying:**
```bash
php artisan storage:link
```

**Frontend changes not showing:**
```bash
npm run dev          # For development
npm run build        # For production
composer run dev     # Alternative development mode
```

**Database migration errors:**
```bash
php artisan migrate:refresh   # Reset and re-run migrations
php artisan migrate:status    # Check migration status
```

## 📞 Support

For issues or questions, please open an issue on [GitHub Issues](https://github.com/askura-bot/rental-kendaraan/issues).

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 🙏 Acknowledgments

- Built with [Laravel](https://laravel.com) framework
- UI components from [Tailwind CSS](https://tailwindcss.com)
- Authentication scaffolding by [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze)
- Testing framework [Pest PHP](https://pestphp.com)

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
