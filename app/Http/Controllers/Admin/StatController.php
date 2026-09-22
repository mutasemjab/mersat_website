<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stat;

class StatController extends BaseCrudController
{
    protected string $model = Stat::class;
    protected string $view = 'admin.stat';
    protected string $route = 'admin.stat';
    protected string $perm = 'stat';
    protected string $plural = 'stats';
    protected string $singular = 'stat';

    protected array $columns = ['value', 'label', 'sort_order', 'status'];

    protected array $translatableRules = [
        'label' => 'required|string|max:100',
    ];

    protected function rules(): array
    {
        return [
            'value'  => 'required|integer|min:0|max:100000000',
            'suffix' => 'nullable|string|max:10',
        ];
    }
}
