<?php

namespace App\Http\Controllers\Admin;

use App\Models\PortfolioItem;
use App\Models\PortfolioMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Clients we worked for. Each one has a cover card (shown on the home page and the portfolio page)
 * and its own page with a description, a website link and a gallery of the work (images / videos).
 */
class PortfolioItemController extends BaseCrudController
{
    protected string $model = PortfolioItem::class;
    protected string $view = 'admin.portfolio';
    protected string $route = 'admin.portfolio';
    protected string $perm = 'portfolio';
    protected string $plural = 'portfolio_items';
    protected string $singular = 'portfolio_item';

    protected array $columns = ['image', 'title', 'tag', 'gallery', 'sort_order', 'status'];

    protected array $translatableRules = [
        'tag'         => 'required|string|max:150',
        'title'       => 'required|string|max:200',
        'description' => 'nullable|string|max:5000',
    ];

    protected array $media = [
        'image' => ['folder' => PortfolioItem::FOLDER, 'kind' => 'image', 'required' => true],
        'video' => ['folder' => PortfolioItem::FOLDER, 'kind' => 'video'],
    ];

    private const IMAGE_EXT = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

    protected function rules(): array
    {
        return ['url' => 'nullable|url|max:500'];
    }

    protected function extraRules(): array
    {
        return [
            'gallery_files'   => 'nullable|array|max:30',
            'gallery_files.*' => 'file|mimes:jpg,jpeg,png,webp,gif,mp4,webm,mov|max:51200',
            'gallery_links'   => 'nullable|string|max:10000',
            'remove_media'    => 'nullable|array',
            'remove_media.*'  => 'integer',
        ];
    }

    protected function afterSave(Request $request, Model $item): void
    {
        // Remove the ticked gallery items
        $removed = $item->media()->whereIn('id', (array) $request->input('remove_media', []))->get();
        foreach ($removed as $media) {
            deleteImage(PortfolioMedia::FOLDER, $media->path);
            $media->delete();
        }

        $order = (int) $item->media()->max('sort_order');

        // Uploaded images / videos
        foreach ((array) $request->file('gallery_files', []) as $file) {
            $isImage = in_array(strtolower($file->getClientOriginalExtension()), self::IMAGE_EXT, true);
            $item->media()->create([
                'type'       => $isImage ? 'image' : 'video',
                'path'       => uploadImage(PortfolioMedia::FOLDER, $file),
                'sort_order' => ++$order,
            ]);
        }

        // Links, one per line: YouTube / Vimeo, or a direct image / video file
        $links = preg_split('/\s+/', (string) $request->input('gallery_links'), -1, PREG_SPLIT_NO_EMPTY);
        foreach ($links as $link) {
            if (!preg_match('#^https?://#i', $link)) {
                continue;
            }
            $ext = strtolower(pathinfo(parse_url($link, PHP_URL_PATH) ?? '', PATHINFO_EXTENSION));
            $item->media()->create([
                'type'       => in_array($ext, self::IMAGE_EXT, true) ? 'image' : 'video',
                'path'       => $link,
                'sort_order' => ++$order,
            ]);
        }
    }

    protected function beforeDelete(Model $item): void
    {
        foreach ($item->media as $media) {
            deleteImage(PortfolioMedia::FOLDER, $media->path);
        }
    }
}
