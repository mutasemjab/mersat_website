<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('portfolio_media', function (Blueprint $table) {
            $table->string('link', 1000)->nullable()->after('path');
        });
    }

    public function down()
    {
        Schema::table('portfolio_media', function (Blueprint $table) {
            $table->dropColumn('link');
        });
    }
};
