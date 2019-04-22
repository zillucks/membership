<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'role_name' => 'Administrator', 'slug' => 'administrator'],
            ['id' => 2, 'role_name' => 'Member', 'slug' => 'member']
        ]);
    }
}