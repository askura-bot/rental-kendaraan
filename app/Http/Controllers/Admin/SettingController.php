<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class SettingController extends Controller implements HasMiddleware
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

    /**
     * The contact setting keys with their default values.
     *
     * @var array<string, string>
     */
    private array $contactKeys = [
        'contact_office_address' => 'Jl. Raya Utama No. 123, Jakarta, Indonesia 10110',
        'contact_whatsapp' => '+62 812 3456 7890',
        'contact_email' => 'info@driveease.com',
        'contact_hours_weekday' => 'Monday - Saturday: 08:00 - 20:00',
        'contact_hours_weekend' => 'Sunday: 09:00 - 17:00',
        'contact_facebook' => '',
        'contact_twitter' => '',
        'contact_instagram' => '',
        'pre_booking_information' => "✓ Have your ID ready\n✓ Bring a valid driving license\n✓ Prepare security deposit\n✓ Check terms & conditions",
    ];

    /**
     * Show the contact settings form.
     */
    public function edit(): View
    {
        $settings = [];
        foreach ($this->contactKeys as $key => $default) {
            $settings[$key] = Setting::getValue($key, $default);
        }

        return view('admin.settings.contact', compact('settings'));
    }

    /**
     * Update the contact settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'contact_office_address' => ['required', 'string', 'max:500'],
            'contact_whatsapp' => ['required', 'string', 'max:50'],
            'contact_email' => ['required', 'email', 'max:255'],
            'contact_hours_weekday' => ['required', 'string', 'max:255'],
            'contact_hours_weekend' => ['required', 'string', 'max:255'],
            'contact_facebook' => ['nullable', 'string', 'max:255'],
            'contact_twitter' => ['nullable', 'string', 'max:255'],
            'contact_instagram' => ['nullable', 'string', 'max:255'],
            'pre_booking_information' => ['nullable', 'string'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::setValue($key, $value);
        }

        return redirect()
            ->route('admin.settings.contact')
            ->with('success', __('Contact settings updated successfully.'));
    }
}
