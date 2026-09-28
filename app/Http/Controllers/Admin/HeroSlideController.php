<?php

namespace App\Http\Controllers\Admin;

use App\Models\HeroSlide;

/**
 * Slides of the home page banner. Each slide: background image (+ optional video) and its own text.
 */
class HeroSlideController extends BaseCrudController
{
    protected string $model = HeroSlide::class;
    protected string $view = 'admin.slide';
    protected string $route = 'admin.slide';
    protected string $perm = 'slide';
    protected string $plural = 'hero_slides';
    protected string $singular = 'hero_slide';

    protected array $columns = ['image', 'title', 'sort_order', 'status'];

    protected array $translatableRules = [
        'kicker'    => 'nullable|string|max:150',
        'title'     => 'nullable|string|max:120',
        'highlight' => 'nullable|string|max:120',
        'subtitle'  => 'nullable|string|max:300',
    ];

    protected array $media = [
        'image' => ['folder' => HeroSlide::FOLDER, 'kind' => 'image', 'required' => true],
        'video' => ['folder' => HeroSlide::FOLDER, 'kind' => 'video'],
    ];

    protected function rules(): array
    {
        return [];
    }
}
