<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends seeder
{
    public function run()
    {
        // TODO: Implement run() method.
        User::create([
            'name'  => 'Ademola',
            'email' => 'ademolaraimi.nig@gmail.com'
        ]);
    }
}