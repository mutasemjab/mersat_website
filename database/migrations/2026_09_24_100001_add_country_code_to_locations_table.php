<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->string('country_code', 2)->nullable()->after('description'); // ISO 3166-1 alpha-2, lights the country up on the map
        });

        // Link the locations the site shipped with to their countries.
        $known = ['Jordan' => 'JO', 'Morocco' => 'MA', 'USA' => 'US', 'Saudi Arabia' => 'SA', 'UAE' => 'AE'];
        foreach (DB::table('locations')->get() as $location) {
            $city = json_decode($location->city, true)['en'] ?? null;
            if (isset($known[$city])) {
                DB::table('locations')->where('id', $location->id)->update(['country_code' => $known[$city]]);
            }
        }
    }

    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('country_code');
        });
    }
};
