<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    private array $permissions = ['logo-table', 'logo-add', 'logo-edit', 'logo-delete'];

    public function up()
    {
        Schema::create('client_logos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150)->nullable(); // used as the image's alt text
            $table->string('logo', 1000);            // uploaded file name or external URL
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        foreach ($this->permissions as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'admin']);
        }
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function down()
    {
        Schema::dropIfExists('client_logos');
        Permission::whereIn('name', $this->permissions)->where('guard_name', 'admin')->delete();
    }
};
