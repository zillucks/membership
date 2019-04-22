<?php

use Illuminate\Database\Seeder;
use App\Models\Identity;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $identities = Identity::whereDoesntHave('user', function ($user) {
            $user->where('username', 'admin');
        })->get();

        foreach ($identities as $identity) {
            $identity->member()->save(factory(App\Models\Member::class)->make());
        }
    }
}
