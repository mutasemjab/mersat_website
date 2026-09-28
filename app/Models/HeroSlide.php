<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * One slide of the home page banner: a background image (and optional video) with its own text.
 * Empty texts fall back to the hero texts of "Website content → Hero".
 */
class HeroSlide extends Model
{
    use HasTranslations;

    public const FOLDER = 'assets/uploads/slides';

    public array $translatable = ['kicker', 'title', 'highlight', 'subtitle'];

    protected $fillable = ['kicker', 'title', 'highlight', 'subtitle', 'image', 'video', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function getImageUrlAttribute(): ?string
    {
        return media_url($this->image, self::FOLDER);
    }

    public function getVideoUrlAttribute(): ?string
    {
        return media_url($this->video, self::FOLDER);
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
