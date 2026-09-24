<?php

namespace App\Support;

/**
 * Describes every editable text / media item of the website.
 *
 * It drives two things:
 *  - the admin "Website Content" pages (one page per group, built from the fields below)
 *  - the default values loaded by SettingSeeder (the content the site shipped with)
 *
 * Field types: text, textarea, url, email, image, video.
 * `tr` = translatable (stored as {"en": "...", "ar": "..."}), otherwise a plain string.
 */
class SiteSettings
{
    private const POSTER = 'https://images.pexels.com/photos/1001682/pexels-photo-1001682.jpeg?auto=compress&cs=tinysrgb&w=1920';
    private const V_HERO = 'https://videos.pexels.com/video-files/1437396/1437396-hd_1920_1080_25fps.mp4';
    private const V_ABOUT = 'https://videos.pexels.com/video-files/2257010/2257010-hd_1920_1080_30fps.mp4';
    private const V_CONTACT = 'https://videos.pexels.com/video-files/857251/857251-hd_1920_1080_30fps.mp4';

    /** Field definition. */
    private static function f(string $type, string $en, string $ar, $defEn = null, $defAr = null, bool $tr = true, bool $required = true): array
    {
        return [
            'type'     => $type,
            'label'    => ['en' => $en, 'ar' => $ar],
            'tr'       => $tr,
            'required' => $required,
            'default'  => $tr ? ['en' => $defEn, 'ar' => $defAr] : $defEn,
        ];
    }

    /** Non-translatable field (same value in both languages). */
    private static function n(string $type, string $en, string $ar, $default = null, bool $required = true): array
    {
        return self::f($type, $en, $ar, $default, null, false, $required);
    }

    public static function groups(): array
    {
        static $groups = null;

        return $groups ??= [

            'general' => [
                'icon'  => 'bi-globe2',
                'title' => ['en' => 'General & Footer', 'ar' => 'عام والتذييل'],
                'fields' => [
                    'site_name'        => self::f('text', 'Site name', 'اسم الموقع', 'Mersat Media', 'ميرسات ميديا'),
                    'site_logo'        => self::n('image', 'Logo (used in the navbar, loader and footer)', 'الشعار (يظهر في الشريط العلوي والتحميل والتذييل)', null, false),
                    'page_title'       => self::f('text', 'Browser page title', 'عنوان الصفحة في المتصفح', 'Mersat Media — Cinematic Marketing Agency | Amman, Jordan', 'ميرسات ميديا — وكالة تسويق سينمائية | عمّان، الأردن'),
                    'meta_description' => self::f('textarea', 'Meta description (SEO)', 'وصف الموقع (SEO)', 'Mersat Media is a cinematic marketing agency in Amman, Jordan — content production, branding, social media and digital campaigns built to make brands unforgettable.', 'ميرسات ميديا وكالة تسويق سينمائية في عمّان، الأردن — إنتاج المحتوى والهوية البصرية ووسائل التواصل والحملات الرقمية التي تجعل العلامات التجارية لا تُنسى.'),
                    'footer_title'     => self::f('text', 'Footer title', 'عنوان التذييل', 'Built in Amman.', 'صُنع في عمّان.'),
                    'footer_subtitle'  => self::f('text', 'Footer subtitle', 'العنوان الفرعي للتذييل', 'Seen Worldwide.', 'يُرى حول العالم.'),
                    'footer_copyright' => self::f('text', 'Copyright text (the year is added automatically)', 'نص حقوق النشر (تُضاف السنة تلقائياً)', 'Mersat Media — Built in Jordan.', 'ميرسات ميديا — صُنع في الأردن.'),
                ],
            ],

            'hero' => [
                'icon'  => 'bi-film',
                'title' => ['en' => 'Hero (top section)', 'ar' => 'الواجهة الرئيسية'],
                'fields' => [
                    'hero_kicker'    => self::f('text', 'Small line above the title', 'السطر الصغير فوق العنوان', 'Cinematic Marketing Agency — Amman, Jordan', 'وكالة تسويق سينمائية — عمّان، الأردن'),
                    'hero_title_1'   => self::f('text', 'Title — first line', 'العنوان — السطر الأول', 'Built in Amman', 'صُنع في عمّان'),
                    'hero_title_thin' => self::f('text', 'Title — second line (light word)', 'العنوان — السطر الثاني (كلمة خفيفة)', 'Seen', 'يُرى'),
                    'hero_title_glow' => self::f('text', 'Title — second line (highlighted word)', 'العنوان — السطر الثاني (كلمة مميزة)', 'Worldwide', 'حول العالم'),
                    'hero_subtitle'  => self::f('textarea', 'Subtitle', 'النص التعريفي', 'We create cinematic content, branding, and digital experiences designed to make brands impossible to ignore.', 'نصنع محتوى سينمائياً وهويات بصرية وتجارب رقمية تجعل علامتك التجارية لا تُنسى.'),
                    'hero_btn1_text' => self::f('text', 'First button — text', 'الزر الأول — النص', 'View Portfolio', 'شاهد أعمالنا'),
                    'hero_btn1_url'  => self::n('url', 'First button — link', 'الزر الأول — الرابط', '#portfolio'),
                    'hero_btn2_text' => self::f('text', 'Second button — text', 'الزر الثاني — النص', 'Start a Project →', 'ابدأ مشروعك ←'),
                    'hero_btn2_url'  => self::n('url', 'Second button — link', 'الزر الثاني — الرابط', '#contact'),
                    'hero_scroll'    => self::f('text', 'Scroll hint text', 'نص التمرير', 'Explore', 'استكشف'),
                    'hero_video'     => self::n('video', 'Background video', 'فيديو الخلفية', self::V_HERO, false),
                    'hero_poster'    => self::n('image', 'Video poster image', 'صورة الغلاف للفيديو', self::POSTER, false),
                ],
            ],

            'services' => [
                'icon'  => 'bi-grid-3x3-gap',
                'title' => ['en' => 'Services section', 'ar' => 'قسم الخدمات'],
                'fields' => [
                    'services_label'    => self::f('text', 'Section label', 'عنوان القسم الصغير', 'What We Build', 'ما نبنيه'),
                    'services_title_1'  => self::f('text', 'Title — first line', 'العنوان — السطر الأول', "We Don't Just Create.", 'نحن لا نصنع المحتوى فحسب.'),
                    'services_title_2'  => self::f('text', 'Title — second line (highlighted)', 'العنوان — السطر الثاني (مميز)', 'We Build Presence.', 'نحن نبني الحضور.'),
                    'services_text'     => self::f('textarea', 'Intro text', 'النص التعريفي', 'From cinematic content production to branding, strategy, and digital campaigns — every detail is crafted to make your brand stand out.', 'من إنتاج المحتوى السينمائي إلى الهوية البصرية والاستراتيجية والحملات الرقمية — كل تفصيل مصمم ليجعل علامتك التجارية تتألق.'),
                    'services_btn_text' => self::f('text', 'Button — text', 'الزر — النص', 'Build With Us →', 'ابنِ معنا ←'),
                    'services_btn_url'  => self::n('url', 'Button — link', 'الزر — الرابط', '#contact'),
                    'services_video'    => self::n('video', 'Showcase video', 'فيديو العرض', self::V_HERO, false),
                    'services_visual_1' => self::f('text', 'Video text — line 1', 'نص الفيديو — السطر 1', 'Cinematic.', 'سينمائي.'),
                    'services_visual_2' => self::f('text', 'Video text — line 2 (highlighted)', 'نص الفيديو — السطر 2 (مميز)', 'Strategic.', 'استراتيجي.'),
                    'services_visual_3' => self::f('text', 'Video text — line 3', 'نص الفيديو — السطر 3', 'Unforgettable.', 'لا يُنسى.'),
                ],
            ],

            'portfolio' => [
                'icon'  => 'bi-collection-play',
                'title' => ['en' => 'Portfolio section', 'ar' => 'قسم الأعمال'],
                'fields' => [
                    'portfolio_label'    => self::f('text', 'Section label', 'عنوان القسم الصغير', 'Portfolio', 'أعمالنا'),
                    'portfolio_title_1'  => self::f('text', 'Title — first line', 'العنوان — السطر الأول', 'Built for Attention.', 'صُنع لجذب الانتباه.'),
                    'portfolio_title_2'  => self::f('text', 'Title — second line (highlighted)', 'العنوان — السطر الثاني (مميز)', 'Backed by Results.', 'مدعوم بالنتائج.'),
                    'portfolio_btn_text' => self::f('text', 'Button — text', 'الزر — النص', 'View Full Portfolio →', 'شاهد كل الأعمال ←'),
                ],
            ],

            'about' => [
                'icon'  => 'bi-info-circle',
                'title' => ['en' => 'About section', 'ar' => 'قسم من نحن'],
                'fields' => [
                    'about_video'       => self::n('video', 'Video (optional — plays over the image)', 'الفيديو (اختياري — يعمل فوق الصورة)', self::V_ABOUT, false),
                    'about_poster'      => self::n('image', 'Image (shown on its own, or until the video loads)', 'الصورة (تظهر وحدها، أو إلى أن يتحمّل الفيديو)', 'https://images.pexels.com/photos/2559941/pexels-photo-2559941.jpeg?auto=compress&cs=tinysrgb&w=800', false),
                    'about_badge_number' => self::n('text', 'Badge — number', 'الشارة — الرقم', '8+'),
                    'about_badge_line1' => self::f('text', 'Badge — line 1', 'الشارة — السطر 1', 'Years of', 'سنوات من'),
                    'about_badge_line2' => self::f('text', 'Badge — line 2', 'الشارة — السطر 2', 'Excellence', 'التميّز'),
                    'about_label'       => self::f('text', 'Section label', 'عنوان القسم الصغير', 'Our Story', 'قصتنا'),
                    'about_title_1'     => self::f('text', 'Title — first line', 'العنوان — السطر الأول', 'Built in Amman.', 'صُنع في عمّان.'),
                    'about_title_2'     => self::f('text', 'Title — second line (highlighted)', 'العنوان — السطر الثاني (مميز)', 'Seen Worldwide.', 'يُرى حول العالم.'),
                    'about_text_1'      => self::f('textarea', 'Paragraph 1', 'الفقرة 1', 'Mersat Media is a creative studio focused on cinematic content, branding, and digital experiences built to make brands unforgettable.', 'ميرسات ميديا استوديو إبداعي متخصص في المحتوى السينمائي والهوية البصرية والتجارب الرقمية التي تجعل العلامات التجارية لا تُنسى.'),
                    'about_text_2'      => self::f('textarea', 'Paragraph 2', 'الفقرة 2', 'From Amman to international collaborations across Morocco, the USA, Saudi Arabia, and the UAE — we create work designed to travel beyond borders.', 'من عمّان إلى تعاونات دولية في المغرب والولايات المتحدة والسعودية والإمارات — نصنع أعمالاً مصممة لتعبر الحدود.'),
                    'about_countries'   => self::f('text', 'Countries line', 'سطر الدول', 'Jordan • Morocco • USA • Saudi Arabia • UAE', 'الأردن • المغرب • أمريكا • السعودية • الإمارات'),
                ],
            ],

            'global' => [
                'icon'  => 'bi-geo-alt',
                'title' => ['en' => 'Worldwide section', 'ar' => 'قسم الحضور العالمي'],
                'fields' => [
                    'global_label'   => self::f('text', 'Section label', 'عنوان القسم الصغير', 'Worldwide Presence', 'حضور عالمي'),
                    'global_title_1' => self::f('text', 'Title — first line', 'العنوان — السطر الأول', 'Built in Amman.', 'صُنع في عمّان.'),
                    'global_title_2' => self::f('text', 'Title — second line (highlighted)', 'العنوان — السطر الثاني (مميز)', 'Seen Worldwide.', 'يُرى حول العالم.'),
                    'global_text'    => self::f('textarea', 'Intro text', 'النص التعريفي', 'From Jordan to collaborations across Morocco, the United States, Saudi Arabia, and the UAE — Mersat Media creates cinematic work designed to travel beyond borders.', 'من الأردن إلى تعاونات في المغرب والولايات المتحدة والسعودية والإمارات — تصنع ميرسات ميديا أعمالاً سينمائية مصممة لتعبر الحدود.'),
                ],
            ],

            'contact' => [
                'icon'  => 'bi-telephone',
                'title' => ['en' => 'Contact section', 'ar' => 'قسم التواصل'],
                'fields' => [
                    'contact_video'        => self::n('video', 'Background video', 'فيديو الخلفية', self::V_CONTACT, false),
                    'contact_label'        => self::f('text', 'Section label', 'عنوان القسم الصغير', 'Get in Touch', 'تواصل معنا'),
                    'contact_title_1'      => self::f('text', 'Title — line 1', 'العنوان — السطر 1', "Let's Build", 'لنبنِ معاً'),
                    'contact_title_2'      => self::f('text', 'Title — line 2', 'العنوان — السطر 2', 'Brands That', 'علامات تجارية'),
                    'contact_title_em'     => self::f('text', 'Title — line 3 (highlighted)', 'العنوان — السطر 3 (مميز)', 'Stand Out', 'تتميّز'),
                    'contact_desc'         => self::f('textarea', 'Intro text', 'النص التعريفي', "Tell us about your vision, and we'll help bring it to life.", 'أخبرنا عن رؤيتك وسنساعدك على تحويلها إلى واقع.'),
                    'contact_phone'        => self::n('text', 'Phone', 'الهاتف', '+962 777 362 233'),
                    'contact_email'        => self::n('email', 'Email', 'البريد الإلكتروني', 'mersatmjo@gmail.com'),
                    'contact_whatsapp'     => self::n('text', 'WhatsApp number (also used by the floating button)', 'رقم واتساب (يُستخدم أيضاً في الزر العائم)', '+962 777 362 233'),
                    'contact_location'     => self::f('text', 'Location', 'الموقع', 'Amman, Jordan', 'عمّان، الأردن'),
                    'contact_location_sub' => self::f('text', 'Location — small line', 'الموقع — السطر الصغير', 'Working Worldwide', 'نعمل حول العالم'),
                    'contact_form_label'   => self::f('text', 'Form label', 'عنوان النموذج الصغير', 'Start Your Project', 'ابدأ مشروعك'),
                    'contact_form_title_1' => self::f('text', 'Form title — first word(s)', 'عنوان النموذج — الكلمة الأولى', 'Start Your', 'ابدأ'),
                    'contact_form_title_em' => self::f('text', 'Form title — highlighted word', 'عنوان النموذج — الكلمة المميزة', 'Project', 'مشروعك'),
                    'contact_form_btn'     => self::f('text', 'Submit button text', 'نص زر الإرسال', 'Start Your Project →', 'ابدأ مشروعك ←'),
                ],
            ],

            'cta' => [
                'icon'  => 'bi-megaphone',
                'title' => ['en' => 'Final call to action', 'ar' => 'الدعوة الختامية'],
                'fields' => [
                    'cta_title_1'   => self::f('text', 'Title — line 1', 'العنوان — السطر 1', "Let's Build Something", 'لنبنِ شيئاً'),
                    'cta_title_2'   => self::f('text', 'Title — line 2', 'العنوان — السطر 2', 'People', 'سيتذكّره'),
                    'cta_title_em'  => self::f('text', 'Title — line 2 (highlighted)', 'العنوان — السطر 2 (مميز)', 'Remember.', 'الجميع.'),
                    'cta_text'      => self::f('textarea', 'Text', 'النص', 'No fluff. No templates. Just cinematic work built to move brands forward.', 'بلا حشو. بلا قوالب جاهزة. فقط أعمال سينمائية تدفع العلامات التجارية إلى الأمام.'),
                    'cta_btn_text'  => self::f('text', 'Button — text', 'الزر — النص', 'Start Your Project', 'ابدأ مشروعك'),
                    'cta_btn_url'   => self::n('url', 'Button — link', 'الزر — الرابط', '#contact'),
                ],
            ],
        ];
    }

    /** Every field flattened: key => definition. */
    public static function fields(): array
    {
        static $all = null;

        if ($all === null) {
            $all = [];
            foreach (self::groups() as $group) {
                $all += $group['fields'];
            }
        }

        return $all;
    }

    /** key => default value, ready to be stored. */
    public static function defaults(): array
    {
        return array_map(fn ($field) => $field['default'], self::fields());
    }
}
