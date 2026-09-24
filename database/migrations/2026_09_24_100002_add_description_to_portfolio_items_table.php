<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->json('description')->nullable()->after('title'); // about the client, shown on its page
        });
    }

    public function down()
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
