<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Rachid Obaka',
            'email' => 'reachme@rachidobaka.com',
            'password' => bcrypt('password'),
        ]);
    }
}
