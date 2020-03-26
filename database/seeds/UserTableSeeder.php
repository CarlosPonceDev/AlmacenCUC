<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = 'josue';
        $user->password = Hash::make('benyi123');
        $user->save();

        $user = new User();
        $user->username = 'araceli';
        $user->password = Hash::make('kimi2329');
        $user->save();
    }
}
