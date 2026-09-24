<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location;
use App\Support\WorldMap;
use Illuminate\Validation\Rule;

class LocationController extends BaseCrudController
{
    protected string $model = Location::class;
    protected string $view = 'admin.location';
    protected string $route = 'admin.location';
    protected string $perm = 'location';
    protected string $plural = 'locations';
    protected string $singular = 'location';

    protected array $columns = ['city', 'country_code', 'description', 'sort_order', 'status'];

    protected array $translatableRules = [
        'city'        => 'required|string|max:100',
        'description' => 'required|string|max:200',
    ];

    protected function rules(): array
    {
        return ['country_code' => ['required', Rule::in(array_keys(WorldMap::data()['countries']))]];
    }
}
