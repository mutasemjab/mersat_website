<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    /** Platforms that have an icon in resources/views/front/partials/social-icon.blade.php. */
    public const PLATFORMS = ['instagram', 'facebook', 'linkedin', 'whatsapp', 'youtube', 'x'];

    protected $fillable = ['platform', 'url', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
