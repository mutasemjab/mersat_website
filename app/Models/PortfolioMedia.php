<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * One image or video of the work done for a client (PortfolioItem).
 */
class PortfolioMedia extends Model
{
    public const FOLDER = 'assets/uploads/portfolio/gallery';

    protected $table = 'portfolio_media';

    protected $fillable = ['portfolio_item_id', 'type', 'path', 'sort_order'];

    public function item()
    {
        return $this->belongsTo(PortfolioItem::class, 'portfolio_item_id');
    }

    public function getUrlAttribute(): ?string
    {
        return media_url($this->path, self::FOLDER);
    }

    /** Embeddable player URL for YouTube / Vimeo links, null for a direct image / video file. */
    public function getEmbedUrlAttribute(): ?string
    {
        $url = (string) $this->path;

        if (preg_match('#(?:youtube\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/)|youtu\.be/)([\w-]{11})#i', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        if (preg_match('#vimeo\.com/(?:video/)?(\d+)#i', $url, $m)) {
            return 'https://player.vimeo.com/video/' . $m[1];
        }

        return null;
    }
}
