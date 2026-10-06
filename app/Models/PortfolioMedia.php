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

    protected $fillable = ['portfolio_item_id', 'type', 'path', 'link', 'sort_order'];

    public function item()
    {
        return $this->belongsTo(PortfolioItem::class, 'portfolio_item_id');
    }

    public function getUrlAttribute(): ?string
    {
        return media_url($this->path, self::FOLDER);
    }

    /** Still image for grids: the image itself, or the YouTube cover. Null for other videos. */
    public function getThumbUrlAttribute(): ?string
    {
        if ($this->type === 'image') {
            return $this->url;
        }

        if (preg_match('#youtube\.com/embed/([\w-]{11})#', (string) $this->embed_url, $m)) {
            return 'https://i.ytimg.com/vi/' . $m[1] . '/hqdefault.jpg';
        }

        return null;
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
