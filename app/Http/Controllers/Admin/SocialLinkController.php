<?php

namespace App\Http\Controllers\Admin;

use App\Models\SocialLink;
use Illuminate\Validation\Rule;

class SocialLinkController extends BaseCrudController
{
    protected string $model = SocialLink::class;
    protected string $view = 'admin.social';
    protected string $route = 'admin.social';
    protected string $perm = 'social';
    protected string $plural = 'social_links';
    protected string $singular = 'social_link';

    protected array $columns = ['platform', 'url', 'sort_order', 'status'];

    protected function rules(): array
    {
        return [
            'platform' => ['required', Rule::in(SocialLink::PLATFORMS)],
            'url'      => 'required|string|max:500',
        ];
    }
}
