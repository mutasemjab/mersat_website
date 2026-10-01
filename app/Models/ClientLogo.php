<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A client's logo, shown in the "Our clients" logo wall of the home page.
 */
class ClientLogo extends Model
{
    public const FOLDER = 'assets/uploads/logos';

    protected $fillable = ['name', 'logo', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function getLogoUrlAttribute(): ?string
    {
        return media_url($this->logo, self::FOLDER);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
