<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        Permission::query()->truncate();
        DB::statement("SET foreign_key_checks = 1");

        Permission::create(['name' => 'create-role']);
        Permission::create(['name' => 'create-permission']);
        Permission::create(['name' => 'create-user']);
    }
}
