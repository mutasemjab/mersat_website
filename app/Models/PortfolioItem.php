<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * A client we worked for: cover card on the website + description + gallery of the work (PortfolioMedia).
 */
class PortfolioItem extends Model
{
    use HasTranslations;

    public const FOLDER = 'assets/uploads/portfolio';

    public array $translatable = ['tag', 'title', 'description'];

    protected $fillable = ['tag', 'title', 'description', 'image', 'video', 'url', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function media()
    {
        return $this->hasMany(PortfolioMedia::class)->orderBy('sort_order')->orderBy('id');
    }

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
