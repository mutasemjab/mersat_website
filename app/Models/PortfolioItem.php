<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PortfolioItem extends Model
{
    use HasTranslations;

    public const FOLDER = 'assets/uploads/portfolio';

    public array $translatable = ['tag', 'title'];

    protected $fillable = ['tag', 'title', 'image', 'video', 'url', 'sort_order', 'is_active'];

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
