<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->json('kicker')->nullable();
            $table->json('title')->nullable();
            $table->json('highlight')->nullable();
            $table->json('subtitle')->nullable();
            $table->string('image', 1000);           // uploaded file name or external URL
            $table->string('video', 1000)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        foreach (['slide-table', 'slide-add', 'slide-edit', 'slide-delete'] as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'admin']);
        }
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Starter slides (replace the images from the admin panel)
        $img = fn (int $id) => "https://images.pexels.com/photos/$id/pexels-photo-$id.jpeg?auto=compress&cs=tinysrgb&w=1920";
        $slides = [
            [$img(1001682), ['en' => 'Cinematic Marketing Agency — Amman, Jordan', 'ar' => 'وكالة تسويق سينمائية — عمّان، الأردن'], ['en' => 'Built in Amman.', 'ar' => 'صُنع في عمّان.'], ['en' => 'Seen Worldwide.', 'ar' => 'يُرى حول العالم.'], ['en' => 'We create cinematic content, branding, and digital experiences designed to make brands impossible to ignore.', 'ar' => 'نصنع محتوى سينمائياً وهويات بصرية وتجارب رقمية تجعل علامتك التجارية لا تُنسى.']],
            [$img(3379934), ['en' => 'Content Production', 'ar' => 'إنتاج المحتوى'], ['en' => 'Stories that', 'ar' => 'قصص'], ['en' => 'move people.', 'ar' => 'تُحرّك الناس.'], ['en' => 'From concept to final cut — commercials, reels and brand films shot with a cinematic eye.', 'ar' => 'من الفكرة إلى المونتاج النهائي — إعلانات وريلز وأفلام للعلامات التجارية بعين سينمائية.']],
            [$img(3184291), ['en' => 'Branding & Strategy', 'ar' => 'الهوية والاستراتيجية'], ['en' => 'Brands built', 'ar' => 'علامات تجارية'], ['en' => 'to be remembered.', 'ar' => 'صُنعت لتُتذكّر.'], ['en' => 'Identity, strategy and campaigns that give your brand a clear voice in every market.', 'ar' => 'هوية واستراتيجية وحملات تمنح علامتك صوتاً واضحاً في كل سوق.']],
            [$img(2559941), ['en' => 'Jordan · Morocco · USA · KSA · UAE', 'ar' => 'الأردن · المغرب · أمريكا · السعودية · الإمارات'], ['en' => 'From Amman', 'ar' => 'من عمّان'], ['en' => 'to the world.', 'ar' => 'إلى العالم.'], ['en' => 'International collaborations designed to travel beyond borders.', 'ar' => 'تعاونات دولية مصممة لتعبر الحدود.']],
        ];
        foreach ($slides as $i => [$image, $kicker, $title, $highlight, $subtitle]) {
            DB::table('hero_slides')->insert([
                'image' => $image, 'kicker' => json_encode($kicker, JSON_UNESCAPED_UNICODE), 'title' => json_encode($title, JSON_UNESCAPED_UNICODE),
                'highlight' => json_encode($highlight, JSON_UNESCAPED_UNICODE), 'subtitle' => json_encode($subtitle, JSON_UNESCAPED_UNICODE),
                'sort_order' => $i + 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }

    public function down()
    {
        Schema::dropIfExists('hero_slides');
        Permission::whereIn('name', ['slide-table', 'slide-add', 'slide-edit', 'slide-delete'])->where('guard_name', 'admin')->delete();
    }
};
