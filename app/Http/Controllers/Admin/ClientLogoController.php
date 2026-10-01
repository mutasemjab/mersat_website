<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClientLogo;

/**
 * Client logos of the home page logo wall: just a logo (and an optional name).
 */
class ClientLogoController extends BaseCrudController
{
    protected string $model = ClientLogo::class;
    protected string $view = 'admin.logo';
    protected string $route = 'admin.logo';
    protected string $perm = 'logo';
    protected string $plural = 'client_logos';
    protected string $singular = 'client_logo';

    protected array $columns = ['logo', 'name', 'sort_order', 'status'];

    protected array $media = [
        'logo' => ['folder' => ClientLogo::FOLDER, 'kind' => 'image', 'required' => true],
    ];

    protected function rules(): array
    {
        return ['name' => 'nullable|string|max:150'];
    }
}
