<?php

namespace App\Http\Controllers\Admin;

use App\Models\PortfolioItem;

class PortfolioItemController extends BaseCrudController
{
    protected string $model = PortfolioItem::class;
    protected string $view = 'admin.portfolio';
    protected string $route = 'admin.portfolio';
    protected string $perm = 'portfolio';
    protected string $plural = 'portfolio_items';
    protected string $singular = 'portfolio_item';

    protected array $columns = ['image', 'title', 'tag', 'sort_order', 'status'];

    protected array $translatableRules = [
        'tag'   => 'required|string|max:150',
        'title' => 'required|string|max:200',
    ];

    protected array $media = [
        'image' => ['folder' => PortfolioItem::FOLDER, 'kind' => 'image', 'required' => true],
        'video' => ['folder' => PortfolioItem::FOLDER, 'kind' => 'video'],
    ];

    protected function rules(): array
    {
        return ['url' => 'nullable|string|max:500'];
    }
}
