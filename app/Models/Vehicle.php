<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Vehicle extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'category_id',
        'name',
        'brand',
        'year',
        'cc',
        'capacity',
        'transmission',
        'price_12h',
        'price_24h',
        'status',
        'description',
        'thumbnail',
        'slug',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'cc' => 'integer',
            'capacity' => 'integer',
            'price_12h' => 'decimal:2',
            'price_24h' => 'decimal:2',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Boot the model - auto-generate slug on creation/update.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $model): void {
            if (! $model->slug) {
                $model->slug = static::generateUniqueSlug($model->name);
            }
        });

        static::updating(function (self $model): void {
            if ($model->isDirty('name') && ! $model->isDirty('slug')) {
                $model->slug = static::generateUniqueSlug($model->name, $model->id);
            }
        });
    }

    /**
     * Generate a unique slug for a vehicle.
     */
    protected static function generateUniqueSlug(string $name, ?int $exceptId = null): string
    {
        $slug = Str::slug($name);
        $count = 1;

        while (static::where('slug', $slug)
            ->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))
            ->exists()) {
            $slug = Str::slug($name) . '-' . $count++;
        }

        return $slug;
    }

    /**
     * Get the category this vehicle belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all images for this vehicle.
     */
    public function images(): HasMany
    {
        return $this->hasMany(VehicleImage::class);
    }
}
