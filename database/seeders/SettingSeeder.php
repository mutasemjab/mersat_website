<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Support\SiteSettings;
use Illuminate\Database\Seeder;

/**
 * Loads the texts and media the website shipped with (see App\Support\SiteSettings).
 * Keys that already exist are left alone, so re-running the seeder never overwrites edits made in the admin.
 */
class SettingSeeder extends Seeder
{
    public function run()
    {
        foreach (SiteSettings::defaults() as $key => $value) {
            if (!Setting::where('key', $key)->exists()) {
                Setting::put($key, $value);
            }
        }
    }
}
