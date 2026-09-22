<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasTranslations;

    public const IMAGE_FOLDER = 'assets/uploads/services';

    /** Built-in icons (drawn in resources/views/front/partials/service-icon.blade.php). */
    public const ICONS = ['camera', 'star', 'grid', 'chart', 'search', 'browser', 'growth', 'hexagon', 'package', 'print'];

    public array $translatable = ['title', 'description'];

    protected $fillable = ['title', 'description', 'icon', 'image', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function getImageUrlAttribute(): ?string
    {
        return media_url($this->image, self::IMAGE_FOLDER);
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
