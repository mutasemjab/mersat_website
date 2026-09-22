<?php

namespace App\Http\Controllers\Admin;

use App\Models\TickerItem;

class TickerItemController extends BaseCrudController
{
    protected string $model = TickerItem::class;
    protected string $view = 'admin.ticker';
    protected string $route = 'admin.ticker';
    protected string $perm = 'ticker';
    protected string $plural = 'ticker_items';
    protected string $singular = 'ticker_item';

    protected array $columns = ['title', 'sort_order', 'status'];

    protected array $translatableRules = [
        'title' => 'required|string|max:150',
    ];

    protected function rules(): array
    {
        return [];
    }
}
