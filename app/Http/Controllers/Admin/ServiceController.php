<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Validation\Rule;

class ServiceController extends BaseCrudController
{
    protected string $model = Service::class;
    protected string $view = 'admin.service';
    protected string $route = 'admin.service';
    protected string $perm = 'service';
    protected string $plural = 'services';
    protected string $singular = 'service';

    protected array $columns = ['icon', 'title', 'description', 'sort_order', 'status'];

    protected array $translatableRules = [
        'title'       => 'required|string|max:150',
        'description' => 'required|string|max:500',
    ];

    protected array $media = [
        'image' => ['folder' => Service::IMAGE_FOLDER, 'kind' => 'image'],
    ];

    protected function rules(): array
    {
        return ['icon' => ['required', Rule::in(Service::ICONS)]];
    }
}
