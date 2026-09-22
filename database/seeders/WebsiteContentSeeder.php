<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\SocialLink;
use App\Models\Stat;
use App\Models\TickerItem;
use Illuminate\Database\Seeder;

/**
 * The repeatable content the website shipped with (English + Arabic).
 * Each table is only filled when it is empty, so re-running never duplicates or overwrites admin edits.
 */
class WebsiteContentSeeder extends Seeder
{
    private const PEXELS_IMG = 'https://images.pexels.com/photos/%d/pexels-photo-%d.jpeg?auto=compress&cs=tinysrgb&w=%d';
    private const PEXELS_VID = 'https://videos.pexels.com/video-files/%s.mp4';

    public function run()
    {
        $this->ticker();
        $this->services();
        $this->portfolio();
        $this->stats();
        $this->locations();
        $this->socialLinks();
    }

    private function ticker(): void
    {
        if (TickerItem::exists()) {
            return;
        }

        $items = [
            ['Cinematic Content', 'محتوى سينمائي'],
            ['Brand Storytelling', 'سرد قصة العلامة التجارية'],
            ['Global Campaigns', 'حملات عالمية'],
            ['Social Media', 'وسائل التواصل الاجتماعي'],
            ['Visual Production', 'إنتاج مرئي'],
            ['Built in Amman', 'صُنع في عمّان'],
            ['Seen Worldwide', 'يُرى حول العالم'],
            ['Creative Strategy', 'استراتيجية إبداعية'],
        ];

        foreach ($items as $i => [$en, $ar]) {
            TickerItem::create(['title' => ['en' => $en, 'ar' => $ar], 'sort_order' => $i + 1, 'is_active' => true]);
        }
    }

    private function services(): void
    {
        if (Service::exists()) {
            return;
        }

        $services = [
            ['camera',  'Content Production', 'إنتاج المحتوى', 'Cinematic content designed to capture attention and build unforgettable brands.', 'محتوى سينمائي مصمم لجذب الانتباه وبناء علامات تجارية لا تُنسى.'],
            ['star',    'Branding', 'الهوية البصرية', 'Bold visual identities that make your brand instantly recognizable.', 'هويات بصرية جريئة تجعل علامتك التجارية مميزة من النظرة الأولى.'],
            ['grid',    'Social Media', 'وسائل التواصل الاجتماعي', 'Strategy-driven content that grows your presence and engagement.', 'محتوى قائم على استراتيجية ينمّي حضورك وتفاعل جمهورك.'],
            ['chart',   'Paid Advertising', 'الإعلانات المدفوعة', 'Performance-focused campaigns built to drive real business results.', 'حملات تركز على الأداء لتحقيق نتائج أعمال حقيقية.'],
            ['search',  'Photography & Videography', 'التصوير الفوتوغرافي والفيديو', 'Premium visuals that bring your brand story to life.', 'مرئيات فاخرة تُحيي قصة علامتك التجارية.'],
            ['browser', 'Website Design', 'تصميم المواقع', 'Modern websites designed to impress and convert visitors into clients.', 'مواقع عصرية مصممة لإبهار الزوار وتحويلهم إلى عملاء.'],
            ['growth',  'Marketing Strategy', 'الاستراتيجية التسويقية', 'Clear marketing strategies built for sustainable brand growth.', 'استراتيجيات تسويقية واضحة لنمو مستدام للعلامة التجارية.'],
            ['hexagon', 'Campaign Launches', 'إطلاق الحملات', 'Launch campaigns created to generate buzz and lasting impact.', 'حملات إطلاق تصنع الضجة وتترك أثراً دائماً.'],
            ['package', 'Packaging Design', 'تصميم العبوات', 'Creative packaging that elevates your product and brand experience.', 'عبوات إبداعية ترتقي بمنتجك وتجربة علامتك التجارية.'],
            ['print',   'Printing Solutions', 'حلول الطباعة', 'High-quality printing solutions crafted for strong brand presentation.', 'حلول طباعة عالية الجودة لتقديم قوي للعلامة التجارية.'],
        ];

        foreach ($services as $i => [$icon, $titleEn, $titleAr, $descEn, $descAr]) {
            Service::create([
                'title'       => ['en' => $titleEn, 'ar' => $titleAr],
                'description' => ['en' => $descEn, 'ar' => $descAr],
                'icon'        => $icon,
                'sort_order'  => $i + 1,
                'is_active'   => true,
            ]);
        }
    }

    private function portfolio(): void
    {
        if (PortfolioItem::exists()) {
            return;
        }

        $img = fn (int $id, int $w) => sprintf(self::PEXELS_IMG, $id, $id, $w);
        $vid = fn (string $file) => sprintf(self::PEXELS_VID, $file);

        $items = [
            ['Brand Identity · USA', 'هوية بصرية · أمريكا', 'UniUni — USA Launch Campaign', 'UniUni — حملة الإطلاق في أمريكا', $img(1001682, 1200), $vid('1739011/1739011-hd_1920_1080_24fps')],
            ['Campaign · Morocco', 'حملة · المغرب', 'Sabaa — Moroccan Expansion', 'Sabaa — التوسع في المغرب', $img(1430676, 800), $vid('2257010/2257010-hd_1920_1080_30fps')],
            ['Social Media · Jordan', 'وسائل التواصل · الأردن', '2M+ Organic Views', 'أكثر من 2 مليون مشاهدة عضوية', $img(3374210, 800), null],
            ['Photography · Jordan', 'تصوير · الأردن', 'Product Launch Shoot', 'جلسة تصوير إطلاق منتج', $img(1295138, 800), null],
            ['Production · Saudi Arabia', 'إنتاج · السعودية', 'Saudi Arabia — Production Collaboration', 'السعودية — تعاون إنتاجي', $img(1268855, 800), null],
            ['Branding · UAE', 'هوية بصرية · الإمارات', 'UAE — Brand Collaboration', 'الإمارات — تعاون في العلامة التجارية', $img(2559941, 800), null],
            ['Launch Campaign · International', 'حملة إطلاق · دولي', 'Global Product Launch — Full Execution', 'إطلاق منتج عالمي — تنفيذ متكامل', $img(1624438, 1200), $vid('1093659/1093659-hd_1920_1080_30fps')],
        ];

        foreach ($items as $i => [$tagEn, $tagAr, $titleEn, $titleAr, $image, $video]) {
            PortfolioItem::create([
                'tag'        => ['en' => $tagEn, 'ar' => $tagAr],
                'title'      => ['en' => $titleEn, 'ar' => $titleAr],
                'image'      => $image,
                'video'      => $video,
                'sort_order' => $i + 1,
                'is_active'  => true,
            ]);
        }
    }

    private function stats(): void
    {
        if (Stat::exists()) {
            return;
        }

        $stats = [
            [40, '+', 'Projects', 'مشاريع'],
            [30, '+', 'Clients', 'عملاء'],
            [5, null, 'Countries', 'دول'],
        ];

        foreach ($stats as $i => [$value, $suffix, $en, $ar]) {
            Stat::create(['value' => $value, 'suffix' => $suffix, 'label' => ['en' => $en, 'ar' => $ar], 'sort_order' => $i + 1, 'is_active' => true]);
        }
    }

    private function locations(): void
    {
        if (Location::exists()) {
            return;
        }

        $locations = [
            ['Jordan', 'الأردن', 'Headquarters · Middle East Hub', 'المقر الرئيسي · مركز الشرق الأوسط'],
            ['Morocco', 'المغرب', 'North Africa Operations', 'عمليات شمال أفريقيا'],
            ['USA', 'أمريكا', 'North America Clients & Projects', 'عملاء ومشاريع أمريكا الشمالية'],
            ['Saudi Arabia', 'السعودية', 'Production Collaborations', 'تعاونات إنتاجية'],
            ['UAE', 'الإمارات', 'Brand Collaborations', 'تعاونات العلامات التجارية'],
        ];

        foreach ($locations as $i => [$cityEn, $cityAr, $descEn, $descAr]) {
            Location::create([
                'city'        => ['en' => $cityEn, 'ar' => $cityAr],
                'description' => ['en' => $descEn, 'ar' => $descAr],
                'sort_order'  => $i + 1,
                'is_active'   => true,
            ]);
        }
    }

    private function socialLinks(): void
    {
        if (SocialLink::exists()) {
            return;
        }

        $links = [
            ['instagram', '#'],
            ['facebook', '#'],
            ['linkedin', '#'],
            ['whatsapp', 'https://wa.me/962777362233'],
        ];

        foreach ($links as $i => [$platform, $url]) {
            SocialLink::create(['platform' => $platform, 'url' => $url, 'sort_order' => $i + 1, 'is_active' => true]);
        }
    }
}
