<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class IdentityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('username', '<>', 'admin')->get();
        foreach($users as $user) {
            $user->identity()->save(factory(App\Models\Identity::class)->make());
        }
    }
}
