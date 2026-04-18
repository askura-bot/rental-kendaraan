<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleImage extends Model
{
    /** @var list<string> */
    protected $fillable = [
        'vehicle_id',
        'image_path',
    ];

    /**
     * Get the vehicle this image belongs to.
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
