<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Stat extends Model
{
    use HasTranslations;

    public array $translatable = ['label'];

    protected $fillable = ['value', 'suffix', 'label', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean', 'value' => 'integer'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
