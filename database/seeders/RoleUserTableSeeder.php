<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        User::findOrFail(1)->roles()->sync(1);
        $users = User::where('user_id', '!=', 1)->get();
        foreach ($users as $user) {
            $user->roles()->sync(2);
        }
    }
}
