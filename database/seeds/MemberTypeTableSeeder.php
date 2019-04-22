<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('member_type')->insert([
            ['id' => 1, 'member_type_name' => 'Blue'],
            ['id' => 2, 'member_type_name' => 'Silver'],
            ['id' => 3, 'member_type_name' => 'Gold'],
            ['id' => 4, 'member_type_name' => 'Platinum'],
        ]);
    }
}
