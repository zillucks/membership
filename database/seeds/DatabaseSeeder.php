<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(MemberTypeTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // $this->call(IdentityTableSeeder::class);
        // $this->call(MemberTableSeeder::class);
        // $this->call(PointTransactionTableSeeder::class);
        // $this->call(PointTransactionDetailTableSeeder::class);
    }
}
