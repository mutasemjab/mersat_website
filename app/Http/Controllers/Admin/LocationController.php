<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location;

class LocationController extends BaseCrudController
{
    protected string $model = Location::class;
    protected string $view = 'admin.location';
    protected string $route = 'admin.location';
    protected string $perm = 'location';
    protected string $plural = 'locations';
    protected string $singular = 'location';

    protected array $columns = ['city', 'description', 'sort_order', 'status'];

    protected array $translatableRules = [
        'city'        => 'required|string|max:100',
        'description' => 'required|string|max:200',
    ];

    protected function rules(): array
    {
        return [];
    }
}
