<?php

namespace App\Http\Controllers;

use App\Models\ClientLogo;
use App\Models\ContactMessage;
use App\Models\HeroSlide;
use App\Models\Location;
use App\Models\PortfolioItem;
use App\Models\PortfolioMedia;
use App\Models\Service;
use App\Models\SocialLink;
use App\Models\Stat;
use App\Models\TickerItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** Clients shown on the home page; the rest are on the portfolio page. */
    private const HOME_CLIENTS = 7;

    /** Latest images / videos (from the clients' galleries) shown in the home page work gallery. */
    private const HOME_WORK = 12;

    public function index()
    {
        return view('front.home', [
            'slides'         => $this->slides(),
            'workMedia'      => PortfolioMedia::with('item')->whereHas('item', fn ($q) => $q->active())->latest('id')->take(self::HOME_WORK)->get(),
            'clientLogos'    => ClientLogo::active()->ordered()->get(),
            'tickerItems'    => TickerItem::active()->ordered()->get(),
            'services'       => Service::active()->ordered()->with('portfolioItems')->get(),
            'portfolioItems' => PortfolioItem::active()->ordered()->take(self::HOME_CLIENTS)->get(),
            'stats'          => Stat::active()->ordered()->get(),
            'locations'      => Location::active()->ordered()->get(),
            'socialLinks'    => SocialLink::active()->ordered()->get(),
        ]);
    }

    /** Banner slides; texts left empty fall back to the hero texts of the settings. */
    private function slides(): array
    {
        $default = [
            'kicker'    => setting('hero_kicker'),
            'title'     => setting('hero_title_1'),
            'highlight' => trim(setting('hero_title_thin') . ' ' . setting('hero_title_glow')),
            'subtitle'  => setting('hero_subtitle'),
        ];

        $slides = HeroSlide::active()->ordered()->get()->map(fn (HeroSlide $s) => [
            'image'     => $s->image_url,
            'video'     => $s->video_url,
            'kicker'    => $s->kicker ?: $default['kicker'],
            'title'     => $s->title ?: $default['title'],
            'highlight' => $s->highlight ?: ($s->title ? '' : $default['highlight']),
            'subtitle'  => $s->subtitle ?: $default['subtitle'],
        ])->all();

        // No slides yet: a single slide from the hero image / video of the settings
        return $slides ?: [$default + ['image' => setting_media('hero_poster'), 'video' => setting_media('hero_video')]];
    }

    /** All clients. */
    public function portfolio()
    {
        return view('front.portfolio', [
            'portfolioItems' => PortfolioItem::active()->ordered()->get(),
            'socialLinks'    => SocialLink::active()->ordered()->get(),
        ]);
    }

    /** One client: description, website link and the work we did for them. */
    public function client(int $id)
    {
        $client = PortfolioItem::active()->with('media')->findOrFail($id);

        $ids = PortfolioItem::active()->ordered()->pluck('id');
        $pos = $ids->search($client->id);

        return view('front.client', [
            'client'      => $client,
            'prev'        => $pos > 0 ? PortfolioItem::find($ids[$pos - 1]) : null,
            'next'        => $pos < $ids->count() - 1 ? PortfolioItem::find($ids[$pos + 1]) : null,
            'socialLinks' => SocialLink::active()->ordered()->get(),
        ]);
    }

    public function contact(Request $request)
    {
        // Hidden "website" field is a honeypot: humans leave it empty, bots fill it in.
        if ($request->filled('website')) {
            return $request->expectsJson() ? response()->json(['message' => __('front.form_success')]) : back();
        }

        $data = $request->validate([
            'name'          => 'required|string|max:150',
            'email'         => 'required|email|max:150',
            'phone'         => 'nullable|string|max:50',
            'business_name' => 'nullable|string|max:150',
            'service'       => 'nullable|string|max:200',
            'message'       => 'required|string|max:3000',
        ], [], [
            'name'          => __('front.form_name'),
            'email'         => __('front.form_email'),
            'phone'         => __('front.form_phone'),
            'business_name' => __('front.form_business'),
            'service'       => __('front.form_service'),
            'message'       => __('front.form_message'),
        ]);

        ContactMessage::create($data);

        if ($request->expectsJson()) {
            return response()->json(['message' => __('front.form_success')]);
        }

        return redirect(route('home') . '#contact')->with('contact_success', __('front.form_success'));
    }
}
