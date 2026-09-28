<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // ── Roles & Employees ──────────────────────────────────────────────
            'role-table',      'role-add',      'role-edit',      'role-delete',
            'employee-table',  'employee-add',  'employee-edit',  'employee-delete',

            // ── Website texts & media (Hero, About, Contact details, …) ────────
            'setting-edit',

            // ── Website content lists ──────────────────────────────────────────
            'slide-table',     'slide-add',     'slide-edit',     'slide-delete',
            'ticker-table',    'ticker-add',    'ticker-edit',    'ticker-delete',
            'service-table',   'service-add',   'service-edit',   'service-delete',
            'portfolio-table', 'portfolio-add', 'portfolio-edit', 'portfolio-delete',
            'stat-table',      'stat-add',      'stat-edit',      'stat-delete',
            'location-table',  'location-add',  'location-edit',  'location-delete',
            'social-table',    'social-add',    'social-edit',    'social-delete',

            // ── Contact form submissions ───────────────────────────────────────
            'message-table',   'message-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'admin']);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
