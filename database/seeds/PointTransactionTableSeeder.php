<?php

use Illuminate\Database\Seeder;
use App\Models\Member;

class PointTransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = Member::where('is_verified', true)->get();
        foreach ($members as $member) {
            $member->transactions()->saveMany(factory(App\Models\PointTransaction::class, mt_rand(1, 10))->make());
        }
    }
}
