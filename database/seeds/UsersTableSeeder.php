<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Identity;
use App\Models\Member;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $user = new User();
        $user->password = 'admin';
        $user->email = 'admin@membership.com';
        $user->email_verified_at = $date->subWeek(rand(0, 10));
        $user->user_log = 'System';
        $user->save();
        
        $identity = new Identity();
        $identity->full_name = 'Administrator';
        $identity->email = $user->email;
        $identity->user_log = 'System';
        $user->identity()->save($identity);
        $member = new Member();
        $member->role_id = 1;
        $member->verified_at = $user->email_verified_at;
        $member->is_verified = true;
        $identity->member()->save($member);

        // $user->identity()->save(factory(App\Models\Identity::class)->make());

        // factory(App\Models\User::class, 10)->create()->each(function ($user) {
        //     $user->identity()->save(factory(App\Models\Identity::class)->make());
        // });
    }
}
